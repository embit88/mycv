document.addEventListener("DOMContentLoaded", function() {

    // SCROLL MENU
    const anchors = document.querySelectorAll('a[href*="#"]')

    if(anchors !== null && anchors.length > 0) {
        for (let anchor of anchors) {
            anchor.addEventListener('click', function (e) {
                e.preventDefault()

                const blockID = anchor.getAttribute('href').substr(1)

                document.getElementById(blockID).scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                })
            })
        }
    }


    // PAGINATE SHOW MORE
    const show_more_button = document.querySelector('.show-more-button');

    if(show_more_button !== null) {
        show_more_button.addEventListener('click', function () {
            show_more_button.setAttribute('disabled', 'disabled');
            let page = parseInt(show_more_button.getAttribute('data-page'));
            let href = show_more_button.getAttribute('data-href');
            let image = show_more_button.getAttribute('data-image');
            let text = show_more_button.getAttribute('data-text');
            let route = show_more_button.getAttribute('data-route');

            let request = new XMLHttpRequest();
            let data = 'page=' + page;

            request.open('POST', route, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.responseType = 'json';

            request.onload = function() {

                const result = this.response;

                if(result !== null) {
                    show_more_button.textContent = text;
                }

                if(result !== null) {
                    show_more_button.removeAttribute('disabled');
                    show_more_button.setAttribute('data-page', page + 1);
                    result.forEach(function (element) {
                        let div = document.createElement("div");
                        div.classList.add('col-12', 'col-sm-6', 'col-lg-4', 'float-left');
                        let slug = href + element['slug'];
                        let src = image + '/' + element['image'];
                        div.innerHTML = "<div class='project-block'> " +
                            "   <a href="+ slug +">\n" +
                            "   <img alt='No Image' src="+ src +">\n" +
                            "   <p class='project-name'>"+ element['name'] +"</p>\n" +
                            // "   <p class='project-text'>"+ element['short_content'] +"</p>\n" +
                                (element['short_content'] !== null && element['short_content'] !== '' ? "   <p class='project-text'>"+ element['short_content'] +"</p>\n" : "") +
                            "   </a></div>";

                        let section = document.querySelector(".section-projects > .row");
                        section.appendChild(div);
                    })
                }

            };

            request.send(data);
        });
    }

});