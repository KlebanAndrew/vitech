(function () {
    'use strict';

    var viewMessage = {
        bindings: {
            message: '<'
        },
        templateUrl: '/app/modules/messages/components/view_message.html',

        controller: function (HttpService, Notify) {
            var vm = this;

            vm.reply = {};

            vm.sendReply = sendReply;

            /**
             * Send reply for message
             */
            function sendReply() {
                if(_.isUndefined(vm.reply.text) || vm.reply.text == ''){
                    Notify.warning('Write something');

                    return;
                }

                var message = {
                    text: vm.reply.text,
                    subject: 'Subject',
                    receiver: vm.message.sender
                };

                HttpService.post('/api/messages/reply', message, function (resp) {
                    Notify.success('Reply send');
                    vm.reply = {};
                }, function (errors) {
                    vm.errors = errors;
                    Notify.warning('Something went wrong');
                });
            }
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

    var messagesList = {
        bindings: {
            type: '<',
            selectedMessage: '='
        },
        templateUrl: '/app/modules/messages/components/messages_list.html',

        controller: function ($timeout, $state, MessagesService) {
            var vm = this;

            vm.page = 1;

            //init function
            vm.$onInit = function () {
                if (_.isUndefined(vm.type)) {
                    vm.type = 'inbox';
                }

                getMessages();
            };

            //on type change get new data
            vm.$onChanges = function (changesObj) {
                if (changesObj.type && !changesObj.type.isFirstChange()) {
                    getMessages();
                }
            };

            vm.selectMessage = selectMessage;

            /**
             * Get selected message
             *
             * @param item
             * @returns {promise|void}
             */
            function selectMessage(item) {
                if (vm.type == 'draft') {
                    return $state.go('messages.draft');
                }
                vm.selectedMessage = item;
            }

            /**
             * Get messages list
             */
            function getMessages() {
                MessagesService.getMessagesListByType(vm.type, vm.page).success(function (resp) {
                    vm.items = resp.data;
                    vm.totalPages = resp.last_page;
                    vm.page += 1;
                    vm.selectedMessage = _.first(vm.items, 1)[0];
                });
            }
        }
    };

    angular
        .module('app.messages.components', [])
        .component('viewMessage', viewMessage)
        .component('createMessage', createMessage)
        .component('messagesList', messagesList)
    ;

})();