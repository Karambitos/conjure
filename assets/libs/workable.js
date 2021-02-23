whr(document).ready(function(){
    whr_embed(47680, {
        detail: 'descriptions',
        base: 'jobs', 
        zoom: 'city', 
        grouping: 'departments'
    });
    console.log(whr_embed);
    return whr_embed;
});



// https://www.workable.com/api/accounts/conjure?details=false

// async function fetchApi(url) {
//     const dataFetch = await fetch(url, {
//         mode: 'no-cors',
//         method: 'GET',
// 		headers: {
//             'Access-Control-Allow-Origin':'*',
//             Accept: 'application/json',
            
//         },
        

//     });
//     //const data = await dataFetch.json();
//     console.log(dataFetch);
//    // return data;
// }
// fetchApi('https://www.workable.com/api/accounts/conjure?details=false');

