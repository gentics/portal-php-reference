{
	"size": 5,
	"query": {
		"bool": {
			"must": {
				"multi_match": {
					"type": "phrase_prefix",
					"query": "{{{ query }}}",
					"fields": [
		              "fields.name.auto"
		            ]
				}
			},
			"must_not": {
				"term": {
					"fields.excludeFromSearch": true
				}
			},
			"filter": [
				{
					"regexp": {
						"language": {
							"value": "{{{ lang }}}",
							"flags": "ANYSTRING"
						}
					}
				},
				{
					"regexp": {
						"project.name.raw": {
							"value": "{{{ projects }}}",
							"flags": "ANYSTRING"
						}
					}
				},
				{
					"regexp": {
						"fields.templateName.raw": {
							"value": "vehicle",
							"flags": "ANYSTRING"
						}
					}
				}
			]
		}
	},
	"highlight": {
		"pre_tags" : [ "%hb%" ],
		"post_tags" : [ "%he%" ],
		"fragment_size": 0,
		"number_of_fragments": 0,
		"fields": {
			"fields.name.auto": {}
		}
	},
	"_source": [
		"uuid",
		"language",
		"fields.name.auto",
		"fields.templateName.raw"
	]
}
