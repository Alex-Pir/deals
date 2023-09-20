<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Установка: генератор документов</title>
        <script src="//api.bitrix24.com/api/v1/"></script>
    </head>
    <body class="antialiased">
    <script>
        BX24.init(function() {

            let bindParametersContact = {
                PLACEMENT: 'CRM_CONTACT_DETAIL_TAB',
                TITLE: 'Генератор документов',
                DESCRIPTION: 'description',
                HANDLER: 'https://deals.local/'
            }

            let bindParametersCompany = {
                PLACEMENT: 'CRM_COMPANY_DETAIL_TAB',
                TITLE: 'Генератор документов',
                DESCRIPTION: 'description',
                HANDLER: 'https://deals.local/'
            }


            let cmd = {
                app_unbind_contact: ['placement.unbind', {PLACEMENT: 'CRM_CONTACT_DETAIL_TAB', HANDLER: 'https://deals.local/'}],
                app_unbind_company: ['placement.unbind', {PLACEMENT: 'CRM_COMPANY_DETAIL_TAB', HANDLER: 'https://deals.local/'}],
                app_bind_company: ['placement.bind', bindParametersCompany],
                app_bind_contact: ['placement.bind', bindParametersContact]
            }

            BX24.callBatch(cmd, function () {
                BX24.installFinish();
            });
        });
    </script>
    </body>
</html>
