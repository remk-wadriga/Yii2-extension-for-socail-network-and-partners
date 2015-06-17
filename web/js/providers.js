Providers = {

    loginFormContainerId: '#login_form_container',

    loginByProviderUrlId: '.login-by-provider',
    loginByProviderFormId: '.login-by-provider',

    errors: {},
    defaultError: 'Error',

    init: function(data){
        if(typeof data != 'undefined'){
            var attributes = [

            ];

            $.each(attributes, function(index, element){
                if(typeof data[element] != 'undefined')
                    Providers[element] = data[element];
            });
        }

        Providers.setHandlers();
    },

    setHandlers: function(){
        Providers.clickLoginByProvider();
        Providers.submitLoginByProviderForm();
    },

    // Handlers

    clickLoginByProvider: function(){
        $(Providers.loginByProviderUrlId).on('click', function(){
            var success = function(json){
                $(Providers.loginFormContainerId).html(json.form);
            };

            Providers.ajx($(this).data('url'), {}, success, 'GET');

            return false;
        });
    },

    submitLoginByProviderForm: function(){
        $(document).on('submit', Providers.loginByProviderFormId, function(){
            var form = $(this);
            var data = form.serialize();
            var url = form.attr('action');

            var success = function(json){
                Api.setTokens(json);
                PbCloud.closeLoginForm();
                PbCloud.setUpPage();
            };

            Providers.ajx(url, data, success);

            return false;
        });
    },

    // END Handlers


    // Private functions

    ajx: function(url, data, success, type, headers, error){
        success = success || function(){};
        error = error || function(){return true};
        type = type || 'POST';
        headers = headers || {};

        $.ajax({
            type: type,
            url: url,
            data: data,
            headers: headers,
            beforeSend: function(){},
            success: function(json){
                success(json);
            },
            complete: function(){},
            error: function(json){
                if(error(json)){
                    var massage = Providers.getMessage(json);
                    PbCloud.showError(massage);
                }
            }
        });
    },

    getMessage: function(json, data){
        var code = Providers.getStatusCode(json);

        var message = Providers.errors[code] ? Providers.errors[code] : Providers.defaultError;

        if(typeof data != 'undefined'){
            $.each(data, function(name, text){
                message = message.replace('{'+name+'}', text);
            });
        }

        return message;
    },

    getStatusCode: function(json){
        var code = json.status;

        if(json.responseText){
            var textMsg = JSON.parse(json.responseText);
            if(textMsg.error_code){
                code = textMsg.error_code;
            }
        }

        return code;
    }

    // END Private functions
};
