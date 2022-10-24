{
	"suggest": {
		"text": "{{{ query }}}",
		"did-you-mean-name": {
			"term": {
				"field": "fields.name.suggest"
			}
		},
		"did-you-mean-binarycontent": {
			"term": {
				"field": "fields.binarycontent.file.content.suggest"
			}
		}
	}
}
