// (function($,b){var a={delay:100,batch:1,queue:[]};$.jqmq=function(c){var l={},j=$.extend(true,{},a,c),f=j.queue,k=j.paused,i=[],g,d,n,m,e;l.add=function(p,o){return n([p],o)};l.addEach=n=function(o,p){if(o){d=false;f=p?o.concat(f):f.concat(o);k||e()}return m()};l.start=e=function(){k=false;if(m()&&!g&&!i.length){(function o(){var q=j.delay,p=j.batch,r=j.complete,s=j.callback;h();if(!m()){d=true;r&&r.call(l);return}i=f.splice(0,p);if(s&&s.call(l,p===1?i[0]:i)===true){f=i.concat(f);i=[]}if(typeof q==="number"&&q>=0){i=[];g=setTimeout(o,q)}})()}};l.next=function(o){var p=j.complete;if(o){f=i.concat(f)}i=[];if(m()){k||e()}else{if(!d){d=true;p&&p.call(l)}}};l.clear=function(){var o=f;h();f=[];d=true;i=[];return o};l.pause=function(){h();k=true};l.update=function(o){$.extend(j,o)};l.size=m=function(){return f.length};l.indexOf=function(o){return $.inArray(o,f)};function h(){g&&clearTimeout(g);g=b}k||e();return l};$.fn.jqmqAdd=function(d,c){d.add(this.get(),c);return this};$.fn.jqmqAddEach=function(d,c){d.addEach(this.get(),c);return this}})(jQuery);
const planes = {
    init: () => {
        let $schedule = $('#schedule');

        $schedule.find('.data')
            .on('click', (event) => {
                let $target = $(event.currentTarget);

                $target.find('.status')
                    .text('В процессе взлета...');

                $.ajax({
                    method: 'POST',
                    async: false,
                    url: '/scripts/action.php/Plane/fly',
                    data: { id: $target.data('id') }
                }).done((json) => {
                    if (json.response) {
                        $target.find('.status')
                            .text('Взлетел')
                    }
                })
            })
    },
    test: () => {
        $(function () {
            // Create a new queue.
            window.queue = $.jqmq({
                // Next item will be processed only when queue.next() is called in callback.
                delay: -1,
                // Process queue items one-at-a-time.
                batch: 1,
                // For each queue item, execute this function, making an AJAX request. Only
                // continue processing the queue once the AJAX request's callback executes.
                callback: function (item) {
                    $(item)
                        .off('click')
                        .css('color', 'gray')
                        .find('.status')
                        .text('В процессе взлета...')
                    ;

                    $.ajax({
                        method: 'POST',
                        url: '/scripts/action.php/Plane/fly',
                        data: { id: item.data('id') }
                    }).done((json) => {
                        // if (json.response) {
                            item
                                .css('color', 'green')
                                .find('.status')
                                .text('Взлетел')
                                .end()
                                .find('button')
                                .attr('disabled', true)
                        // }
                        queue.next();
                    })

                    // $.getJSON('action.php?items[]=' + item, function (data) {

                    //     $('#output')

                    //         .append(data.html)

                    //         .find('.pending')

                    //         .remove();

                    //     data.success && $('#output .error').remove();

                    //     // If the request was unsuccessful, make another attempt.

                    //     queue.next(!data.success);

                    //     // Update the "Size" display.

                    //     // set_size();

                    // });

                },

                // When the queue completes naturally, execute this function.

                complete: function () {

                    $('#schedule').append('<span style="background-color: green">DONE<\/span>');

                }

            });



            // Disable AJAX caching.

            $.ajaxSetup({ cache: false });

            // On mouseover, add an item to the queue.

            $('#schedule .data').click(function (event) {

                var item = $(this).text();

                let $target = $(event.currentTarget);

                $target.css('color', 'red').find('.status')
                       .text('В очереди...');
                
                queue.add($target);


                // Update the "Last" display.

                // set_last(item);

                // Update the "Size" display.

                // set_size();

            });
            // Bind queue actions to nav buttons.



            // nav('Pause', 'Queue paused.', function () {
            //     queue.pause();
            // });
            // nav('Start', 'Queue started.', function () {
            //     queue.start();
            // });
            // nav('Clear', 'Queue cleared.', function () {
            //     queue.clear();
            // });
            // nav('Batch = 1', 'Queue batch size set to 1.', function () {
            //     queue.update({ batch: 1 });
            // });
            // nav('Batch = 4', 'Queue batch size set to 4.', function () {
            //     queue.update({ batch: 4 });
            // });

        });
    }
}