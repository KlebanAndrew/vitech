(function () {
    'use strict';

    angular.module('app.messages')
        .controller('MessagesCtrl.main', MessagesCtrl_main)
        .controller('MessagesCtrl.create', MessagesCtrl_create)
    ;

    MessagesCtrl_main.$inject = ['$state'];

    function MessagesCtrl_main($state) {
        var vm = this;

    }

    MessagesCtrl_create.$inject = ['contactsList'];

    function MessagesCtrl_create(contactsList) {
        var vm = this;

        vm.contacts = contactsList.data;

    }

})();