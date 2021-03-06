/* MEDIABOX STUFF */
document.addEventListener("DOMContentLoaded", function() {
  console.log('DOMContentLoaded');
  MediaBox('.mediabox');
});


/* GRACENOTE API STUFF */
var apikey = "m5sb66gw46nh6cddagsumbtk";
var baseUrl = "http://data.tmsapi.com/v1.1";
var stationID = "97965";
// var stationID = "30763";
var lineupID = "USA-OTA11216";
var showtimesUrl = baseUrl + "/stations/" + stationID + "/airings";
var zipCode = "78701";
var d = new Date();
var isoStart = isoString(d, 0);
var isoEnd = isoString(d, 6);
let scheduleState = {
  dayActive: 1,
  jsonResponse: '',
}

// standard debounce function, use for scroll event listeners
// usage
// window.addEventListener('scroll', debounce(yourFuncHere));
function debounce(func, wait = 20, immediate = true) {
  var timeout;
  return function() {
    var context = this,
      args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};

function pad(number) {
  if (number < 10) {
    return '0' + number;
  }
  return number;
}
// date is a js date object. use new Date() to get the current datetime
// offset is days to offset. 0 for today, >0 for a future day (so 7 returns a week of programming data)
function isoString(date, offset) {
  return date.getUTCFullYear() +
    '-' + pad(date.getUTCMonth() + 1) +
    '-' + pad(date.getUTCDate() + offset) +
    'T' + pad(date.getUTCHours() - 4) + // apparently the api needs local time? this gives GMT, but then we get results 4 hrs in the future
    ':' + pad(date.getUTCMinutes()) +
    // ':' + pad(date.getUTCSeconds()) +
    // '.' + (date.getUTCMilliseconds() / 1000).toFixed(3).slice(2, 5) +
    'Z';
};

function renderControls(date) {
  const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  const month = monthNames[d.getMonth()].substring(0, 3);
  document.querySelector('.js_schedule-controls__month span').innerText = month.toLowerCase();
  const week = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
  let dayNum = date.getDay();
  let dayName = date.toString().split(' ')[0]; // gets first 3 letters of day name
  let dateNum = date.getDate();
  let dayStart = week.indexOf(dayName.toLowerCase());

  let newWeek = ``
  for (var i = 0; i < 7; i++) {
    if (dayStart + i > 6){
      dayStart = -i;
    }
    newWeek += `<div class="schedule-controls__week__day js_schedule-controls__week__day date-${dateNum + i} js_date-${dateNum + i} day-${i + 1} js_controls-day-${i + 1}" data-day="${i + 1}" data-date="${dateNum + i}">
      <div class="day-name">${week[dayStart + i]}</div>
      <div class="day-num">${dateNum + i}</div>
    </div>`
  }

  document.querySelector('.js_schedule-controls__week').innerHTML = newWeek;
  document.querySelector('.js_controls-day-1').classList.add('active');

  //attach click handlers
  const controls = document.querySelectorAll('.js_schedule-controls__week__day');
  controls.forEach(function(day){
    day.addEventListener('click', function(){
      document.getElementById('section-schedule').scrollIntoView();
      updateScheduleState(parseInt(day.dataset.day));
    })
  });

  const controlPrev = document.querySelector('.schedule-controls__prev');
  controlPrev.addEventListener('click', function(){
    let prevDay = scheduleState.dayActive - 1;
    if (prevDay < 1) {
      prevDay = 7;
    }
    updateScheduleState(prevDay);
    document.getElementById('section-schedule').scrollIntoView();

  });

  const controlNext = document.querySelector('.schedule-controls__next');
  controlNext.addEventListener('click', function(){
    let nextDay = scheduleState.dayActive + 1;
    if (nextDay > 7) {
      nextDay = 1;
    }
    updateScheduleState(nextDay);   
    document.getElementById('section-schedule').scrollIntoView();
  });


  // need to hide this here, because having it in the DOM fucks up the measurements for fixControls
  document.querySelector('.js_cs-loader').remove();


  const scheduleControls = document.querySelector('.schedule-controls');
  const wrap = document.querySelector('.schedule-controls-wrapper');
  
  function fixControls(){
    const scrollTop = document.body.scrollTop;
    const wrapOffsetTop = wrap.offsetTop;
     if((document.querySelector('.section-live').offsetTop - 240) <= scrollTop) {
      scheduleControls.classList.remove('fixed');
      scheduleControls.style = '';
    } else  if (scrollTop + document.querySelector('.js_site-header').offsetHeight >= wrapOffsetTop) {
      scheduleControls.classList.add('fixed');
      scheduleControls.style = `width:${wrap.offsetWidth}px;`;
    } else {
      scheduleControls.classList.remove('fixed');
      scheduleControls.style = '';
    }
  }

  window.addEventListener('scroll', debounce(fixControls));
}



function revealThumbnails(thumbs, parent){
  let i = 0;
  function revealNextThumb() {
    setTimeout(function(){
      thumbs[i].src = thumbs[i].dataset.src;
      thumbs[i].classList.add('active');
      i++;
      //let isInView = parent.classList.contains('active');
      if (i < thumbs.length ) {
        revealNextThumb();
      }
    }, 600)
  }
  revealNextThumb();
}


function dataHandler(data){
  const today = new Date();
  renderControls(today);

  let programming = ``;
  let curDay = 0;
  //let curDate = ('0' + today.getDate()).slice(-2); //add a leading zero, then return the last 2 chars of string
  let curDate = pad(today.getDate());
  let isNewDay = false;
  let isFirstDay = true;

  data.forEach(result => {

    const t = result.startTime.indexOf('T');
    const colon = result.startTime.indexOf(':');
    const z = result.startTime.indexOf('Z');

    if (result.startTime.substring(0, t) !== curDate) {
      // if we're on a new day, update curDate and set the flag to true
      curDate = result.startTime.substring(0, t);
      curDay++;
      isNewDay = true;
    } else {
      // otherwise, make sure the flag is false
      isNewDay = false
    }

    if (isNewDay) {
      // if we're on a new day, close the previous .schedule__day and open a new one
      programming += `</div>`;
      if (isFirstDay) {
        programming += `<div class="schedule__day js_schedule__day active schedule__day-${curDay} js_schedule__day-${curDay}" data-day="${curDay}">`;
        isFirstDay = false;
      } else {
        programming += `<div class="schedule__day js_schedule__day schedule__day-${curDay} js_schedule__day-${curDay}" data-day="${curDay}">`;
      }
    }
    
    let startHour = result.startTime.substring(t + 1, colon);
    let period = 'am';
    if (startHour > 12){
      startHour -= 12;
      period = 'pm';
    } 
    if (startHour < 1) {
      startHour = 12;
    }
    const startMinute = result.startTime.substring(colon + 1, z);
    const image = 'http://developer.tmsimg.com/assets/' + result.program.preferredImage.uri + '?api_key=' + apikey; 
    programming += `<div class="program">
      <div class="program__thumbnail">
        <img class="img-responsive" src="" data-src="${image}" alt="${result.program.title}">
      </div>
      <div class="program__info">
        <div class="program__info__left">
          <div class="time">${startHour}:${startMinute}${period}</div>
        </div>
        <div class="program__info__right">
          <div class="title">${result.program.title}</div>
          <div class="episode">`;

    if (result.program.seasonNum) {
      programming += `S${result.program.seasonNum}`;
    }

    if (result.program.episodeNum) {
      programming += `.E${result.program.episodeNum} `;
    }

    if (result.program.episodeTitle) {
      programming +=  `${result.program.episodeTitle}`;
    }

    programming += '</div>';

    if (result.program.shortDescription) { 
      programming += `<div class="description">${result.program.shortDescription}</div>`;
    }

    const todayDate = `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;

    if (result.program.releaseDate === todayDate) {
      programming += `<div class="new"<span>New</span></div>`;
    }

    // S${result.program.seasonNum}.E${result.program.episodeNum} ${result.program.episodeTitle}</div>
        // <div class="description">${result.program.shortDescription}</div>
    programming +=` </div></div></div>`;
  });

  programming += `</div>`;

  document.querySelector('.js_schedule').innerHTML = programming;
  document.querySelector('.js_schedule-loading-wrapper').classList.remove('hidden');
  revealThumbnails(
    document.querySelectorAll('.js_schedule__day-1 .program__thumbnail img'),
    document.querySelector('.js_schedule__day-1')
  );

  //add the json object to the state
  updateScheduleState(scheduleState.dayActive, JSON.stringify(data));
  saveJSON();
}

function saveJSON(){
  sessionStorage.setItem('scheduleJSON', scheduleState.jsonResponse);
  sessionStorage.setItem('dateStored', d.getDate());
}

function getJSON(){
  if (parseInt(sessionStorage.getItem('dateStored')) === d.getDate()) {
    // if the data is from today, use the stored json
    return sessionStorage.getItem('scheduleJSON');
  } else {
    // if the data is a day or more old, delete it and make a new call
    sessionStorage.clear();
    return false;
  }
}

//newDay is required (pass scheduleState.dayActive to keep same), jsonResponse is optional
function updateScheduleState(newDay, jsonResponse = scheduleState.jsonResponse) {
  scheduleState.dayActive = newDay;
  scheduleState.jsonResponse = jsonResponse;
  updateScheduleView(scheduleState);
}

function updateScheduleView(scheduleState){
  const dayActive = scheduleState.dayActive;
  document.querySelector('.js_schedule-controls__week__day.active').classList.remove('active');
  document.querySelector('.js_schedule__day.active').classList.remove('active');
  document.querySelector('.js_controls-day-' + dayActive).classList.add('active');
  document.querySelector('.js_schedule__day-' + dayActive).classList.add('active');
  const scheduleActive = '.js_schedule__day-' + dayActive;
  revealThumbnails(
    document.querySelectorAll('.js_schedule__day-' + dayActive + ' .program__thumbnail img'),
    document.querySelectorAll(scheduleActive)
  );
}

function scheduleInit(){
  if (document.querySelector('#section-schedule')) {
    var data = getJSON();
    //this way we don't do multiple time-consuming api calls per session
    if (data) {
      dataHandler(JSON.parse(data));
    } else {
      // using jquery because im laaaaaaazy
      jQuery.ajax({
        url: showtimesUrl,
        data: {
          startDateTime: isoStart,
          endDateTime: isoEnd,
          lineupId: lineupID,
          jsonp: "dataHandler",
          api_key: apikey
        },
        dataType: "jsonp",
      });
    }
  }
}

function placeFinder(){
  // console.log('placeFinder');
  // appropriate placement
  var headerFinder = document.querySelector('.js_header-channel-finder');
  headerFinder.style = `margin-bottom:-${headerFinder.offsetHeight}px`;
  headerFinder.classList.remove('offpage');
}

function finderInit(){
  placeFinder();
  window.addEventListener('resize', placeFinder);
  // window.onresize = placeFinder();

  // event listener for the button
  document.querySelector('.js_button-find').addEventListener('click', function(){
    this.classList.toggle('active');
    document.querySelector('.js_header-channel-finder').classList.toggle('active');
    document.querySelector('.js_button-finder-close').classList.toggle('hidden');
  });

  document.querySelector('.js_button-finder-close').addEventListener('click', function(){
    document.querySelector('.js_header-channel-finder').classList.remove('active');
    document.querySelector('.js_button-finder-close').classList.add('hidden');
  });

  // event listeners for zip lookup func
  document.querySelectorAll('.js_zip-lookup__submit').forEach(function(button){
    button.addEventListener('click', function(){
      const zip = button.parentNode.querySelector('.zip-lookup__input').value;
      displayResults(zip);
    });
  });

  document.querySelectorAll('.zip-lookup').forEach(function(form){
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const zip = form.querySelector('.zip-lookup__input').value;
      displayResults(zip);
    })
  });
}

function displayResults(zipcode) {
  console.log('displayResults()');
  const aid = 'zap2it';
  const stnlt = '59987,71484,84543,55337,68615,97965';
  const nstnlt  = true;
  const lid = '';
  const zip = zipcode;

  let url = 'http://api.zap2it.com/tvlistings/webservices/channelFinder?rty=html';
  if (aid != null && aid != '') {
      url += '&aid=' + aid;
  }
  if (stnlt != null && stnlt != '') {
      url += '&stnlt=' + stnlt;
  }
  if (nstnlt != null && nstnlt != '') {
      url += '&nstnlt=' + nstnlt;
  }       
  if (lid != null && lid != '') {
      url += '&lid=' + lid + '';
  }
  if (zip != null && zip != '') {
      url += '&zip=' + zip + '';
  }
  // let results = '<div id="zcc-channelfinder-header"><h2>Light TV Channel Finder</h2></div>';
  // results += '<script type="text/javascript" src="' + url + '"></scr'+ 'ipt>';
  // console.log(results);

  let results = jQuery.ajax(url)
    .done(function(data){
      let resp = data.replace("document.write('", "");
      resp = resp.replace("');", "");
      document.querySelector('#resp').innerHTML = resp;
      if (document.querySelector('#resp .zcc-new-lineup td:nth-child(1)') !== null) {
        let lineup = document.querySelector('#resp .zcc-new-lineup td:nth-child(1)').innerText;
        let channel = document.querySelector('#resp .zcc-new-lineup td:nth-child(2)').innerText;
        const containers = document.querySelectorAll('.js_lookup-result');
        containers.forEach(function(container){
          container.querySelector('.js_lookup-result div:nth-child(1)').innerText = lineup;
          container.querySelector('.js_lookup-result div:nth-child(2)').innerText = channel;
        });
      } else {
        let lineup = 'No result found';
        let channel = '';
        const containers = document.querySelectorAll('.js_lookup-result');
        containers.forEach(function(container){
          container.querySelector('.js_lookup-result div:nth-child(1)').innerText = lineup;
          container.querySelector('.js_lookup-result div:nth-child(2)').innerText = channel;
        })
      }
    })
    .fail(function(){
      let lineup = 'No result found';
      let channel = '';
      const containers = document.querySelectorAll('.js_lookup-result');
      containers.forEach(function(container){
        container.querySelector('.js_lookup-result div:nth-child(1)').innerText = lineup;
        container.querySelector('.js_lookup-result div:nth-child(2)').innerText = channel;
      })
    });

}

function toggleMobileMenu(){
  document.querySelector('.js_mobile-menu').classList.toggle('active');
  document.body.classList.toggle('mobile-menu-active');
}

function mobileMenuInit(){
  // document.querySelectorAll('.js_menu-toggle').forEach(function(button){
  //   button.addEventListener('click', function(){
  //     toggleMobileMenu();
  //   });
  // });
  document.querySelector('.js_menu-open').addEventListener('click', function(){
    toggleMobileMenu();
  });
  document.querySelector('.js_menu-close').addEventListener('click', function(){
    toggleMobileMenu();
  });
}

jQuery(document).ready(function(){
  mobileMenuInit();
  scheduleInit();
  finderInit();  
});
