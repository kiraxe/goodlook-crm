"use strict";


function AjaxAutocom (element, obj, url, parent) {
    this.element = document.querySelector(element);
    this.obj = obj;
    this.url = url;
    this.parentItem = document.querySelectorAll(parent);
    this.button = document.querySelector('.buttonRecover');


    this.hide = function() {
        for (let i = 0; i < this.parentItem.length; i++) {

            let notHide = this.parentItem[i].querySelector(element);

            if (!notHide) {
                this.parentItem[i].classList.add('hidden');
            }

        }
        this.button.classList.add('active');
    }

    this.show = function() {
        for (let i = 0; i < this.parentItem.length; i++) {

            if (this.parentItem[i].classList.contains('hidden')) {
                this.parentItem[i].classList.remove('hidden');
            }
        }
        this.button.classList.remove('active');
    }

    this.recover = function(){
        this.button.addEventListener('click', event => {

            event.preventDefault();

            let url = Routing.generate(this.url);
            let redirect = this.obj.toLowerCase() + '_index';
            redirect = Routing.generate(redirect);

            let data = {
                param: this.element.value,
                obj: this.obj,
                recover: true
            };

            let options = {
                method: "POST",
                body: JSON.stringify(data),
            };

            let response = fetch(url, options)
                .then(response => {

                    if (response.status !== 200) {
                        console.log('Looks like there was a problem. Status Code: ' + response.status);
                        return;
                    }
                    response.text().then(data => {
                        window.location.href = redirect;
                        console.log(JSON.parse(data));
                    }).catch(function(err) {
                        console.log('Fetch Error :-S', err);
                    })
                })
        })
    }

    this.create = function(){
        let wrapperDiv = document.createElement('div');
        wrapperDiv.className = "autocompleteContainer";

        return wrapperDiv;
    }

    this.init = function() {

        let wrapper = this.create();
        let self = this;
        this.recover();

        this.element.addEventListener('keyup', event => {

            let url = Routing.generate(this.url);

            let data = {
                param: this.element.value,
                obj: this.obj,
                recover: false
            };

            let options = {
                method: "POST",
                body: JSON.stringify(data),
            };

            let response = fetch(url, options)
                .then(response => {
                    if (response.status !== 200) {
                        console.log('Looks like there was a problem. Status Code: ' + response.status);
                        return;
                    }

                    response.text().then(data => {
                        let res = JSON.parse(data);
                        wrapper.innerHTML = "";



                        if(res.length == 0) {
                            this.show();
                        }

                        Object.keys(res).forEach(function (key) {
                            Object.keys(this[key]).forEach(function (key) {
                                let div = document.createElement('div');
                                div.append(this[key]['name']);
                                div.className = "autocompleteItem";
                                wrapper.append(div);

                            }, this[key]);
                        }, res);


                        this.element.after(wrapper);

                        if (this.element.value == "" || wrapper.children.length == 0) {
                            wrapper.style.display = "none";
                        } else {
                            wrapper.style.display = "block";
                        }


                        for (let i = 0; i < wrapper.children.length; i++) {
                            wrapper.children[i].addEventListener('click',  () => {
                                let searchParams;
                                searchParams = wrapper.children[i].innerText;
                                this.element.value = searchParams;
                                wrapper.style.display = "none";
                                self.hide();
                            });
                        }

                        console.log(JSON.parse(data));
                    })
                }).catch(function(err) {
                    console.log('Fetch Error :-S', err);
                })
        });
    }
}
