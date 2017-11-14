(function () {
    'use strict';

    angular
        .module('app.messages')

        .service('MessagesService', MessagesService);

    MessagesService.$inject = ['$http'];

    function MessagesService($http) {
        var baseUrl = '/api/messages';

        return {
            contactsList: contactsListFn,
            getMessagesList: getMessagesListFn,
            getMessage: getMessageFn,
            deleteMessage: deleteMessageFn,
            formatDate: formatDateFn
        };

        /**
         * Get messages list
         *
         * @param type ('received', 'sent', 'draft')
         * @returns {*}
         */
        function contactsListFn() {
            return $http.get('api/contacts');//todo Make with HttpService
        }

        /**
         * Get messages list
         *
         * @param type ('received', 'sent', 'draft')
         * @returns {*}
         */
        function getMessagesListFn(type) {
            var params = {
                type: type
            };

            return $http.get(baseUrl, { params: params });//todo Make with HttpService
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
         * Delete message
         *
         * @param id
         * @returns {*}
         */
        function deleteMessageFn(id) {
            return $http.delete(baseUrl + '/' + id);
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