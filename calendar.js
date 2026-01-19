const calendarEl = document.getElementById("calendar");
const monthYearEl =document.getElementById("monthYear");
const modalEl =document.getElementById("eventModal");
let currentDate = new Date();


function renderCalendar(){
    calendarEl.innerHTML = ' ';

    const year = date.getFullYear();
    const month = date.getMonth();
    const today = new Date();


    const totalDays = new Date(year,month +1,0).getDate();
    const firstDayOfMonth = new (year,month,1).getDay();

    //Display month and year
    monthYearEl.textContent = date.toLocalDateString("en-US",{
        month:'long',
        year:'numeric'
    })

    const weekDays = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
    weekDays.forEach(day => {
        const dayEl = document.createElement("div");
        dayEl.className ="day-name";
        dayEl.textContent=day;
        calendarEl.appendChild(dayEl);
    });

    for(let i=0; i< firstDayOfMonth; i++){
        calendarEl.appendChild(document.createElement("div"));
    }

    //Loop throught days
    for(let day =1; day <= totalDays; day++){
        const dateStr = `${year}- ${String(month+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;

        const cell = document.createElement("div");
        cell.className ="day";

        if(
            day === today.getDate &&
            month === today.getMonth() &&
            year == today.getFullYear()
        ){
            cell.classList.add("today");
        }

        const dateEl = document.createElement("div");
        dateEl.className = "date-number";
        dateEl.textContent=day;
        cell.appendChild(dateEl);

        const eventToday =events.filter(e => e.date ==dateStr);
        const eventBox =document.createElement("div");
        eventBox.className ="events";

        //Render events
        eventsToday.forEach(event =>{
            const ev = document.createElement("div");
            courseEl.className ="course";
            courseEl.textContent =event.title.split(" - ")[0];

            const instructorEl = document.createElement("div");

            instructorEl.className ="instructor";
            instructorEl.textContent ="👨🏻‍🏫" + event.title.split(" - ")[1];

            const timeEl =document.createElement("div");
            timeEl.className ="time";
            timeEl.textContent = "⏰" + event.start_time + event.end_time();
            
            ev.appendChild(courseEl);
            ev.appendChild(instructorEl);
            ev.appendChild(timeEl);
            eventBox.appendChild(ev);
        });


        //Overlay buttons
        const overlay = document.createElement("div");
        overlay.className = "day-overlay";
        
        const addBtn = document.createElement("button");
        addBtn.className ="overlay-btn";
        addBtn.textContent = "+Add";
        addBtn.onclick = e =>{
            e.stopPropagation();
            openModalForAdd(dateStr);
        }

        overlay.appendChild(addBtn);

        if(eventToday.length > 0){
            const editBtn =document.createElement("button");
            editBtn.className ="overlay-btn";
            editBtn.textContent ="Edit";
            editBtn.onclick =e=>{
                e.stopPropagation();
                openModalForEdit(eventToday);
            };

            overlay.appendChild(editbtn);
        }

        cell.appendChild(overlay);
        cell.appendChild(eventBox);
         calendarEl.appendChild(cell);
    }
}

