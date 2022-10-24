import com.gentics.mesh.plugin.auth.MappingResult;
import com.gentics.mesh.core.rest.user.UserUpdateRequest;
import com.gentics.mesh.core.rest.group.GroupResponse;
import com.gentics.mesh.core.rest.role.RoleResponse;
import com.gentics.mesh.core.rest.role.RoleReference;
import io.vertx.core.json.JsonArray;
import io.vertx.core.json.JsonObject;

static def printToken(JsonObject token) {
	String username = token.getString("preferred_username");
	System.out.println("Token for {" + username + "}");
	System.out.println(token.encodePrettily());
}

MappingResult result = new MappingResult();

if (uuid == null) {
	log.debug("First time login of the user");
} else {
	log.debug("Already synced user is logging in.");
}

JsonArray roles = token.getJsonArray("roles");
JsonArray groups = token.getJsonArray("groups");

// Set User Details
String username = token.getString("preferred_username");
String firstName = token.getString("given_name");
String lastName = token.getString("family_name");
String email = token.getString("email");

UserUpdateRequest user = new UserUpdateRequest();

user.setUsername(username);
user.setEmailAddress(email);
user.setFirstname(firstName);
user.setLastname(lastName);

result.setUser(user);

// Collect roles
List<RoleResponse> roleList = new ArrayList<>();

for (int i = 0; i < roles.size(); i++) {
	String role = roles.getString(i);
	roleList.add(new RoleResponse().setName(role));
}

result.setRoles(roleList);

// Collect Groups
List<GroupResponse> groupList = new ArrayList<>();

for (int i = 0; i < groups.size(); i++) {
	String group = groups.getString(i);
	GroupResponse groupResponse = new GroupResponse().setName(group);
	List<RoleReference> rolesInGroup = new ArrayList<>();

	for (int ri = 0; ri < roles.size(); ri++) {
		String role = roles.getString(ri);
		rolesInGroup.add(new RoleReference().setName(role));
	}

	groupResponse.setRoles(rolesInGroup);
	groupList.add(groupResponse);
}

result.setGroups(groupList);

return result;
