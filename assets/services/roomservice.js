// const localhosturl="http://127.0.0.1:5500";
// const githuburl="https://roh-arjun.github.io";
// const productionurl="https://555ventures.in";

async function fetchProperties(id) {
    try {
        const response = await fetch('assets/services/data.json');
        const roomslist = await response.json();
        console.log(roomslist)   
        roompopulate(roomslist,id)         
    } catch (error) {
        console.error('Error fetching properties:', error);
    }
}

function getQueryParams() {
    const params = {};
    const queryString = window.location.search.substring(1);
    const queries = queryString.split("&");
    queries.forEach(query => {
        const [key, value] = query.split("=");
        params[key] = decodeURIComponent(value);
    });
    return params;
}
// Use the query string parameters
document.addEventListener("DOMContentLoaded", () => {
    const params = getQueryParams();
        console.log(params.id)   
        fetchProperties(params.id)    
});

function roompopulate(roomslist,id){
    const roomId = parseInt(id);
    const room = roomslist.find(r => r.id === roomId);

    if(room!=undefined){
        // document.getElementById('img1').setAttribute('src', `${room.img1}`);
        // document.getElementById('img1').style.backgroundImage = `url(${room.img1})`;
        // document.getElementById('img2').style.backgroundImage = `url(${room.img2})`;
        // document.getElementById('img3').style.backgroundImage = `url(${room.img3})`;
        // document.getElementById('img1').setAttribute('src', `${room.img1}`);
        // document.getElementById('img2').setAttribute('src', `${room.img2}`);
        // document.getElementById('img3').setAttribute('src', `${room.img3}`);
        function addImportantStyle(selector, property, value) {
            let styleElement = $('#dynamic-styles');
            if (!styleElement.length) {
                // Create a <style> element if it doesn't exist
                styleElement = $('<style id="dynamic-styles"></style>');
                $('head').append(styleElement);
            }
            // Append the new style rule
            styleElement.append(`${selector} { ${property}: ${value} !important; }`);
        }
        
        // Apply styles with !important
        addImportantStyle('#img1', 'background-image', `url(${room.img1})`);
        addImportantStyle('#img2', 'background-image', `url(${room.img2})`);
        addImportantStyle('#img3', 'background-image', `url(${room.img3})`);
       
        document.getElementById('roomprice').innerHTML=room.price;
        document.getElementById('roomname').innerHTML=room.display;
        document.getElementById('food').innerHTML=room.food;
        document.getElementById('firecamp').innerHTML=room.firecamp;
        document.getElementById('music').innerHTML=room.music;
        document.getElementById('games').innerHTML=room.games;

    }
    
}

