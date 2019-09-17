{
	"query": {
		"bool": {
	    	"must": [
		        {
		        	"multi_match": {
		            	"query": "{{{ query }}}",
		            	"type": "phrase",
		            	"fields": [
		            		"fields.name",
		            		"fields.vehicle_description"
		            	]
		        	}
		        },
		        {
		        	"term": {
		            	"fields.templateName.raw": "vehicle"
		        	}
		    	}
		    ],
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
			"fields.vehicle_description.basicsearch": {},
			"fields.name.basicsearch": {}
		}
	},
	"aggregations": {
		"searchtags": {
			"terms": {
				"field": "fields.searchtags.taglist",
				"size": 9999,
				"min_doc_count": 1
			}
		}
	},
	"_source": [
		"project.name",
		"uuid",
		"language",
		"fields.name",
		"fields.vehicle_description",
		"fields.templateName"
	]
}
