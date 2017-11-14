(function () {
    'use strict';

    angular
        .module('app.messages')

        .service('MessagesService', MessagesService);

    MessagesService.$inject = ['$http', 'HttpService'];

    function MessagesService($http) {

        var service = {
            contactsList: contactsListFn,
            getSendMessagesList: getSendMessagesListFn,
            getInboxMessagesList: getInboxMessagesListFn,
            getDraftMessagesList: getDraftMessagesList,
            getMessage: getMessageFn,
            formatDate: formatDateFn
        };

        return service;

        /**
         * Get contacts list
         *
         * @returns {*}
         */
        function contactsListFn() {
            return $http.get('api/contacts');
        }

        /**
         * Get send messages list
         *
         * @param page
         */
        function getSendMessagesListFn(page) {
            page = page || 1;

            return $http.get('api/messages/send', {page: page});
        }

        /**
         * Get inbox messages list
         *
         * @param page
         */
        function getInboxMessagesList(page) {
            page = page || 1;

            return $http.get('api/messages/inbox', {page: page});
        }

        /**
         * Get draft messages list
         *
         * @param page
         */
        function getDraftMessagesList(page) {
            page = page || 1;

            return $http.get('api/messages/draft', {page: page});
        }

        /**
         * Get message
         *
         * @param id
         * @returns {*}
         */
        function getMessageFn(id) {
            return $http.get(baseUrl + '/' + id);
        }

        /**
         * Transform date to USA format
         *
         * @param date
         * @returns {*}
         */
        function formatDateFn(date) {
            return moment(date.substring(0, 10)).format('MM-DD-YYYY');
        }
    }

})();