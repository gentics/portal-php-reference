function extractRoles(principle) {
    return ["reference_role"]; // extractGroups(principle);
}

function extractGroups(principle) {
    //load('API/keycloak/groups?email=' + principle.email);

    var groups = ["reference_group"];
    //groups = groups.concat(groupsadd);

    return groups;
}
