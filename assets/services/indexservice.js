const localhosturl="http://127.0.0.1:5500";
const githuburl="https://roh-arjun.github.io";
const productionurl="https://555ventures.in";

async function fetchProperties() {
    try {
        const response = await fetch('assets/services/data.json');
        const roomslist = await response.json();
        console.log(roomslist)
        allrooms(roomslist)
        couplerooms(roomslist)
        familyrooms(roomslist)
        grouprooms(roomslist)
        singleroom(roomslist)
        
    } catch (error) {
        console.error('Error fetching properties:', error);
    }
}

function allrooms(roomslist){
    const roomContainer = document.getElementById('allrooms');

    roomslist.forEach((room, index) => {
        const roomHtml = `
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a><img class="img-fluid" src="${room.img1}" alt=""></a>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-2">₹ ${room.price}</h5>
                                <div style="text-align: center;">
                                <p class="d-block h5 mb-2"  data-bs-toggle="modal" data-bs-target="#exampleModal">${room.display}</p>
                                 <a href="rooms-single.html" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
    `;
    // Correct way to append the HTML
    roomContainer.innerHTML += roomHtml; // Append, don't overwrite
    });
}

function couplerooms(roomslist){
    const roomContainer = document.getElementById('couplerooms');
    const filteredPropertiesell = roomslist.filter(room => room.type=== "Couple");
    // console.log(filteredPropertiesell)
    // console.log(properties.length)
    filteredPropertiesell.forEach((room, index) => {
        const roomHtml = `
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a><img class="img-fluid" src="${room.img1}" alt=""></a>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-2">₹ ${room.price}</h5>
                                <div style="text-align: center;">
                                <p class="d-block h5 mb-2"  data-bs-toggle="modal" data-bs-target="#exampleModal">${room.display}</p>
                                 <a href="rooms-single.html" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
    `;
    // Correct way to append the HTML
    roomContainer.innerHTML += roomHtml; // Append, don't overwrite
    });

}

function familyrooms(roomslist){
    const roomContainer = document.getElementById('familyrooms');
    const filteredPropertiesell = roomslist.filter(room => room.type=== "Family");
    // console.log(filteredPropertiesell)
    // console.log(properties.length)
    filteredPropertiesell.forEach((room, index) => {
        const roomHtml = `
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a><img class="img-fluid" src="${room.img1}" alt=""></a>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-2">₹ ${room.price}</h5>
                                <div style="text-align: center;">
                                <p class="d-block h5 mb-2"  data-bs-toggle="modal" data-bs-target="#exampleModal">${room.display}</p>
                                 <a href="rooms-single.html" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
    `;
    // Correct way to append the HTML
    roomContainer.innerHTML += roomHtml; // Append, don't overwrite
    });
}

function grouprooms(roomslist){
    const roomContainer = document.getElementById('grouprooms');
    const filteredPropertiesell = roomslist.filter(room => room.type=== "Group");
    // console.log(filteredPropertiesell)
    // console.log(properties.length)
    filteredPropertiesell.forEach((room, index) => {
        const roomHtml = `
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a><img class="img-fluid" src="${room.img1}" alt=""></a>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-2">₹ ${room.price}</h5>
                                <div style="text-align: center;">
                                <p class="d-block h5 mb-2"  data-bs-toggle="modal" data-bs-target="#exampleModal">${room.display}</p>
                                 <a href="rooms-single.html" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
    `;
    // Correct way to append the HTML
    roomContainer.innerHTML += roomHtml; // Append, don't overwrite
    });
}

function singleroom(roomslist){
    const roomContainer = document.getElementById('singleroom');
    const filteredPropertiesell = roomslist.filter(room => room.type=== "Single");
    // console.log(filteredPropertiesell)
    // console.log(properties.length)
    filteredPropertiesell.forEach((room, index) => {
        const roomHtml = `
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a><img class="img-fluid" src="${room.img1}" alt=""></a>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-2">₹ ${room.price}</h5>
                                <div style="text-align: center;">
                                <p class="d-block h5 mb-2"  data-bs-toggle="modal" data-bs-target="#exampleModal">${room.display}</p>
                                 <a href="rooms-single.html" class="btn btn-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
    `;
    // Correct way to append the HTML
    roomContainer.innerHTML += roomHtml; // Append, don't overwrite
    });
}



fetchProperties();