
document.getElementById("demo3").innerHTML = "Vyberte datum v požadovaném rozmezí";


function myFunctionOpenWindow(inputNumber) {

    document.getElementById(`pole${inputNumber}`).innerHTML = `<input type="date" id="calendar${inputNumber}" onchange="updateSelectedDate(${inputNumber})">`;

}



function myFunctionCloseWindow(inputNumber) {

    document.getElementById(`pole${inputNumber}`).innerHTML = '';

}



function updateSelectedDate(inputNumber) {

    const calendarInput = document.getElementById(`calendar${inputNumber}`);

    const selectedDateInput = document.getElementById(`selectedDate${inputNumber}`);

    const selectedNameInput = document.getElementById(`selectedDate${inputNumber}`);



    // Získání vybraného data

    const selectedDate = calendarInput.value;



    // Rozdělení data na části

    const dateParts = selectedDate.split('-');



    // Formátování data do DD.MM.YYYY

    const formattedDate = `${dateParts[2]}.${dateParts[1]}.${dateParts[0]}`;



    // Nastavení formátovaného data do vstupního pole

    selectedDateInput.value = formattedDate;



    //test

    //document.write("ID inputu je: " + selectedNameInput.id);

}