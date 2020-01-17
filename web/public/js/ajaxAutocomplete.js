"use strict";

var element = document.querySelectorAll('.ajax-autocomplete');
var nameAvto = document.querySelector('.nameAvto');
var brandAvto = document.querySelector('.brandAvto');
var modelAvto = document.querySelector('.modelAvto');
var bodyId = document.querySelector('.bodyId');
var colorAvto = document.querySelector('.colorAvto');
var numberAvto = document.querySelector('.numberAvto');
var vinAvto = document.querySelector('.vinAvto');
var phoneAvto = document.querySelector('.phone');
var emailAvto = document.querySelector('.email');
var wrapperDiv = document.createElement('div');
wrapperDiv.className = "autocompleteContainer";

for (let i = 0; i < element.length; i++) {

    element[i].addEventListener('keyup', function (event) {

        let url = Routing.generate('orders_ajaxautocomplete');
        let self = this;

        let data = {
            param: this.value,
            data_type: this.getAttribute('data-type'),
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
                    let clients = JSON.parse(data);

                    wrapperDiv.innerHTML = "";

                    Object.keys(clients).forEach(function (key) {
                        Object.keys(this[key]).forEach(function (key) {
                            let div = document.createElement('div');
                            if (self.getAttribute('data-type') == 'name') {
                                div.append(this[key]['name'] + "-" + this[key]['avto'] + ' ' + this[key]['number']);
                            } else if (self.getAttribute('data-type') == 'number') {
                                div.append(this[key]['number']);
                            } else if (self.getAttribute('data-type') == 'vin') {
                                div.append(this[key]['vin']);
                            } else if (self.getAttribute('data-type') == 'phone') {
                                div.append(this[key]['phone']);
                            }
                            div.className = "autocompleteItem";
                            wrapperDiv.append(div);

                        }, this[key]);
                    }, clients);


                    this.after(wrapperDiv);

                    if (element.value == "" || wrapperDiv.children.length == 0) {
                        wrapperDiv.style.display = "none";
                    } else {
                        wrapperDiv.style.display = "block";
                    }

                    for (let i = 0; i < wrapperDiv.children.length; i++) {
                        wrapperDiv.children[i].addEventListener('click', function () {
                            let searchParams;
                            if (self.getAttribute('data-type') == 'name') {
                                searchParams = this.innerText.split('-');
                                self.value = searchParams[0];
                            } else {
                                searchParams = this.innerText;
                                self.value = searchParams;
                            }

                            wrapperDiv.style.display = "none";

                            Object.keys(clients).forEach(function (key) {
                                Object.keys(this[key]).forEach(function (key) {
                                    if (self.value == this[key][self.getAttribute('data-type')]) {

                                        let arrayParamsAvto = this[key]['avto'].split(' ');


                                        for (let i = 0; i < brandAvto.children.length; i++) {
                                            if (brandAvto.children[i].innerText == arrayParamsAvto[0]) {
                                                brandAvto.children[i].setAttribute('selected', 'selected');
                                            }
                                        }

                                        for (let i = 0; i < modelAvto.children.length; i++) {
                                            if (modelAvto.children[i].innerText == arrayParamsAvto[1]) {
                                                modelAvto.children[i].setAttribute('selected', 'selected');
                                            }
                                        }

                                        for (let i = 0; i < bodyId.children.length; i++) {
                                            if (bodyId.children[i].innerText == arrayParamsAvto[2]) {
                                                bodyId.children[i].setAttribute('selected', 'selected');
                                            }
                                        }

                                        colorAvto.value = arrayParamsAvto[3];
                                        nameAvto.value = this[key]['name'];
                                        numberAvto.value = this[key]['number'];
                                        vinAvto.value = this[key]['vin'];
                                        phoneAvto.value = this[key]['phone'];
                                        emailAvto.value = this[key]['email'];

                                    }
                                }, this[key]);
                            }, clients);

                        });
                    }

                    console.log(JSON.parse(data));
                });
            }).catch(function (err) {
                console.log('Fetch Error :-S', err);
            })
    });

}
