(function () {
    'use strict';

    angular.module('app.messages')
        .controller('MessagesCtrl.main', MessagesCtrl_main)
    ;

    MessagesCtrl_main.$inject = ['BreadcrumbsService'];

    function MessagesCtrl_main(BreadcrumbsService) {
        var vm = this;

        BreadcrumbsService.push('Offer List');

    }

})();