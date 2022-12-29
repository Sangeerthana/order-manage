const fetchEbayData = async (data) =>  {
    let header = {
			method: data.method||'GET',
			headers: {
				'Content-Type': 'text/xml; charset=UTF8',
				'X-EBAY-API-CALL-NAME': 'GetOrders',
				'X-EBAY-API-SITEID': 3,
				'X-EBAY-API-COMPATIBILITY-LEVEL': 1283,
			}
    }

    if(typeof data.body != 'undefined') {
			let body = new Proxy(data.body, {
					get: function(obj, prop) {
							return obj[prop] ? obj[prop] : 'property does not exist';
					}
			})
			header.body = JSON.stringify(body)
    }

    let f = await fetch(data.url, header)

    try {
			let j = f.json()
			if(f.statusText == 'OK') {	
					j.then(result => {
							data.success(result)
					})
			} else {
					j.then(result => {
							data.error(result)
					})
			}
    } catch (e) {
      data.error(e)
    }
}

export default fetchEbayData