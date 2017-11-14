(function () {
    'use strict';

    angular.module('app.messages')
        .controller('MessagesCtrl.main', MessagesCtrl_main)
        .controller('MessagesCtrl.create', MessagesCtrl_create)
    ;

    MessagesCtrl_main.$inject = [''];

    function MessagesCtrl_main() {
        var vm = this;


    }

    MessagesCtrl_create.$inject = [''];

    function MessagesCtrl_create() {
        var vm = this;


    }

})();