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

angular
    .module('app.messages.components', [])
    .component('viewMessage', viewMessage)
;

})();