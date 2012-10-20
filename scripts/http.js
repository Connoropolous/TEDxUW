function strload(str) {
	console.log("loaded string");
	
	thisURL = "https://data.primal.com/ted@Everything/" + str;
	
    $.ajax({
	  type: "GET",
	  url: thisURL,
	  cache: true,
	  dataType: 'jsonp',
	  jsonp: 'callback',
	  jsonpCallback: 'ajaxCallBack',
	  crossDomain: true,
	  username: 'jennifer@madhattertech.ca',
	  password: 'd49mABgXKn',
	  success: function() {
		  alert("success");
	  }
	});
	
}

function ajaxCallBack(data) {
	
	console.log(data);
    
	var queryURI = data['skos:ConceptScheme']['skos:hasTopConcept'][0]; 
	var queryWords = data['skos:ConceptScheme']['skos:Collection'][queryURI]['skos:narrower'];
	
	for (i in queryWords) {
				var descendantConceptURI = queryWords[i];
				// prints 'groups' and 'rock'
				console.log(data['skos:ConceptScheme']['skos:Collection'][descendantConceptURI]['skos:prefLabel'])
				words.push(data['skos:ConceptScheme']['skos:Collection'][descendantConceptURI]['skos:prefLabel']);
	}
}



  
 
         