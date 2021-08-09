const planes = {
    init: () => {
        let $schedule = $('#schedule');

        $schedule.find('.data')
            .on('click', (event) => {
                let $target = $(event.currentTarget);
                let timeout;
                let timer = $.ajax({
                    method: 'POST',
                    url: '/scripts/action.php/Plane/fly',
                    data: { id: $target.data('id') }
                }).then((data) => {
                    console.log(data);
                        if (data.state) {
                            $target.find('.status')
                            .text(data.state);
                        } else if (data.error) {
                            $target.find('.status')
                            .text('Error')
                        }
                }).fail(() => {
                    console.log('fail')
                });
                timeout = setTimeout(timer, 2000);
                $target.find('.status')
                       .text('В процессе взлета...');
            });

            $('.history').on('click', (event) => {
                // TODO event on every history button
                const container = $('.chart');
                if (container.data('id') == $(event.currentTarget).find('button').data('id')) {
                    let id = $(event.currentTarget).find('button').data('id');
                    container.toggleClass('hide');
                    event.stopPropagation();
                }

             })
    }
}