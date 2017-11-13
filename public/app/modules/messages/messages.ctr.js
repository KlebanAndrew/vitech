(function () {
    'use strict';

    angular.module('app.messages')
        .controller('MessagesCtrl.main', MessagesCtrl_main)
    ;

    MessagesCtrl_main.$inject = ['HttpService'];

    function MessagesCtrl_main(HttpService) {
        var vm = this;


    }

})();