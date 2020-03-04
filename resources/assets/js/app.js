
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function(){

    // while(true){
    makeCollapse();
    $(window).resize(function(){
        makeCollapse();
    })

    function makeCollapse(){
        if($(document).width() < 550) {
            $('.add-collapse').addClass('collapse');
        }
        else 
        {
            $('.collapse').removeClass('collapse')
        }
    }

    $('form.no-send').submit(function(){
        return false;
    });

    $('form.filters input').keyup(function(e){
        let filter = $(this);
        if(filter.hasClass('filters__name')){
            applyFilter('.item__name a', filter.val());
        }
        if(filter.hasClass('filters__user')){
            applyFilter('.order__users div', filter.val());
        }
    });

    function applyFilter(selector, string){
        $(selector+":not(:unRegContains("+string+"))").closest('.order').hide();
        $(selector+":unRegContains("+string+")").closest('.order').show();
    }

    jQuery.expr[":"].unRegContains = jQuery.expr.createPseudo(function(arg) {
        return function( elem ) {
            return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });

    $('.order-edit').on('click', function(e){
        var elem = $(this);
        $.ajax({
            url: '/order/'+$(this).data('id')+'/edit/'+getPage()+'/'+$(this).data('anchor'),
            success: function(data){
                elem.parent().after(data);
                elem.detach();
            },
            error: function(data){
                console.log(data);
                alert('Произошла ошибка');
            }
        });
        /*var parent = $(this).parent(); 
        var qty = parent.find('span.qty').text();
        parent.parent().find('input[name=qty]').val(qty);
        parent.parent().find('input[name=userId]').val($(this).data('user'));*/
        return false;
    });

    function getPage(){
        var url = new URL(window.location.href);
        var page = url.searchParams.get("page");
        return page ? page : 1;
    }

    $('.report-rate').on('keyup', function(){
        var input = $(this).val();
        $('.report__user-topay, .report__total-topay').each(function(i, e){
            var ru = $(e).find('.ru')[0];
            if(ru != undefined){
                $($(ru).parent().find('.by')[0]).text(' или '+(input * parseInt($(ru).text())).toFixed(2) + ' BYN');
            }
        })
    });

    // }

    // labelMediaElements();
    // $('.order__more_open').click(function(){
    //     var selector = getSelector(elem = $(this));
    //     selector.css({'max-height': calculateHeight(selector)+'px'});
    //     elem.hide().next().show();
    //     return false;
    // })
    
    // $('.order__more_close').click(function(){
    //     getSelector(elem = $(this)).css({'max-height': '0px'});
    //     elem.hide().prev().show();
    //     return false;
    // })

    // function getSelector(elem) {
    //     return elem.closest('.order').find('.media-hide');
    // }

    // function calculateHeight(elem) {
    //     var height = 0;
    //     elem.children().each(function(i, e){
    //         height += $(e).outerHeight(true);
    //     });
    //     return height;
    // }

    // function labelMediaElements() {
    //     $('.order__info, .order__create').each(function(){
    //         if($(this).css('max-height') == '0px') {
    //             $(this).addClass('media-hide');
    //         }
    //     });
    // }



    
    
    // jQuery.fn.outerHTML = function(s) {
    //     return s
    //         ? this.before(s).remove()
    //         : jQuery("<p>").append(this.eq(0).clone()).html();
    // };

});
