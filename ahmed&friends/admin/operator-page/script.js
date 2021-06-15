function filterItems(event) {
    /* get word to search */
    var searchWord = document.getElementById('search').value
    /* get all events */
    var events =  document.querySelectorAll('.card.item')
    for (var event of events) { /* iterate over each event */
        /* get data of event */
        var title = event.querySelector('.card-title').textContent
        var date = event.querySelector('.date').textContent
        var price =  event.querySelector('.price').textContent
        var desc = event.querySelector('.card-text').textContent
        
        /* verify if search exists in any of the event data */
        var verifyTexts = [title, date, price, desc].some((item) => item.includes(searchWord))
       

            
        /* if some text matchs show the event otherwise hide */
        if (verifyTexts) {
            event.style.display = "block"
        } else {
            event.style.display = "none"
        }
    }
}

