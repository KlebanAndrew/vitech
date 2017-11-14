(function () {
    'use strict';

    var viewMessage = {
        bindings: {
            message: '<'
        },
        templateUrl: '/app/modules/messages/components/view_message.html',

        controller: function () {
            var vm = this;

            //init function
            vm.$onInit = function () {

            };
        }
    };

    var createMessage = {
        bindings: {
            contacts: '<'
        },
        templateUrl: '/app/modules/messages/components/create_message.html',

        controller: function ($state, HttpService) {
            var vm = this;

            //init function
            vm.$onInit = function () {

            };

            vm.sendMessage = sendMessage;

            function sendMessage() {
                HttpService.post('/api/messages', vm.message, function (resp) {
                    $state.go('messages.list');
                }, function (errors) {
                    vm.errors = errors.errors;
                });
            }
        }
    };

angular
    .module('app.messages.components', [])
    .component('viewMessage', viewMessage)
    .component('createMessage', createMessage)
;

})();