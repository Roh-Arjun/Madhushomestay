// const localhosturl="http://127.0.0.1:5500";
// const githuburl="https://roh-arjun.github.io";
// const productionurl="https://555ventures.in";

async function fetchProperties(id) {
    try {
        const url = 'assets/services/data.json?' + new Date().getTime(); // Append current time
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Cache-Control': 'no-cache',  // Ensure the request is not cached
                'Pragma': 'no-cache',         // Add additional cache control headers
                'Expires': '0',               // Expire the cache immediately
            }
        });
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
        sessionStorage.setItem('roomid', params.id);
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

function sharefunc(event){
	event.preventDefault();
    const roomid = sessionStorage.getItem('roomid');

	 // Check for Web Share api support
	 if (navigator.share) {
    // Browser supports native share api
    navigator.share({
      text: 'Please check out',
      url: 'https://madhushomestay.in/rooms-single.html?id='+roomid
    }).then(() => {
      console.log('Thanks for sharing!');
    })
      .catch((err) => console.error(err));
  } else {
    // Fallback
    alert("The current browser does not support the share function. Please, manually share the link")
  }
}


function whatsappmessage(){
    const roomid = sessionStorage.getItem('roomid');
    const path='https://madhushomestay.in/rooms-single.html?id='+roomid;
    
   // const url=window.location.protocol+"//"+window.location.host+`/shareproperty.html?id=${encodeURIComponent(id)}`
    const text="https://wa.me/+919916896464?text=I'm%20interested%20in%20your%20homestay%20"+path
    location.href=text;
}

