function extractRoles(principle) {
    return extractGroups(principle);
}

function extractGroups(principle) {
    //load('API/keycloak/groups?email=' + principle.email);

    var groups = ["anonymous"];
    //groups = groups.concat(groupsadd);

    return groups;
}
