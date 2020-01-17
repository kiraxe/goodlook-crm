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

                                        //let arrayParamsAvto = this[key]['avto'].split(' ');

                                        let selectedParam,
                                            regex;

                                        let newAvto = this[key]['avto'];

                                        for (let i = 0; i < brandAvto.children.length; i++) {
                                            regex = new RegExp(brandAvto.children[i].innerText,'i');
                                            selectedParam = regex.exec(this[key]['avto']);

                                            if (brandAvto.children[i].innerText == selectedParam) {
                                                brandAvto.children[i].setAttribute('selected', 'selected');
                                            }

                                            regex = new RegExp(selectedParam,'i');
                                            newAvto = newAvto.replace(selectedParam , '');

                                        }

                                        for (let i = 0; i < modelAvto.children.length; i++) {

                                            regex = new RegExp(modelAvto.children[i].innerText,'i');
                                            selectedParam = regex.exec(this[key]['avto']);



                                            if (modelAvto.children[i].innerText == selectedParam) {
                                                modelAvto.children[i].setAttribute('selected', 'selected');
                                            }

                                            regex = new RegExp(selectedParam,'i');
                                            newAvto = newAvto.replace(selectedParam , '');
                                        }

                                        for (let i = 0; i < bodyId.children.length; i++) {

                                            regex = new RegExp(bodyId.children[i].innerText,'i');
                                            selectedParam = regex.exec(this[key]['avto']);

                                            if (bodyId.children[i].innerText == selectedParam) {
                                                bodyId.children[i].setAttribute('selected', 'selected');
                                            }

                                            regex = new RegExp(selectedParam,'i');
                                            newAvto = newAvto.replace(selectedParam , '');
                                        }

                                        newAvto = newAvto.replace(/\s/g, '');

                                        colorAvto.value = newAvto;
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

