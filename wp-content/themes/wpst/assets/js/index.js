var cart = $('#shopping-cart');
var foods = $('.to-basket');

if (hasAnyItem()) {
    loadBasketItems();
    updateItog();
}

foods.each(function (index) {
    food = $(this);
    food.on('click', function (e) {
        e.preventDefault();
        setOrIncr($(this).data('id'), $(this).data('title'), $(this).data('price'))
    })
});


$('#clear-basket').on('click', function () {
    cart.empty();
    updateItems([]);
    updateItog();
    $('#itogopar').css({display: 'none'});
    $('#btn_oformit').css({display: 'none'});
    $('#clear-basket').css({display: 'none'})
});

$('#mobile-cart-show').on('click', function () {
    var state = $(this).data('tg');
    $('#bg-black').fadeToggle('slow');
    if (state === 0) {
        $('#shopping-cart-container').css({overflow: 'scroll'}).animate({height: '60%'}, function () {
            $('#top-mobile-cart').css({position: 'fixed', width: '100%', zIndex: 100})
        });
        $(this).data('tg', 1);
    } else {
        $('#shopping-cart-container').css({overflow: 'hidden'}).animate({height: '60px'});
        $(this).data('tg', 0);
    }
});

$('#bg-black').on('click', function () {
    $('#bg-black').fadeToggle('slow');
    $('#shopping-cart-container').css({overflow: 'hidden'}).animate({height: '60px'});
    $('#mobile-cart-show').data('tg', 0);
});

// function updateIncrDecrBtn() {
//     $('.incr').each(function () {
//         $(this).on('click', function () {
//             incrItem(parseInt($($(this).siblings()[1]).attr('id')))
//         })
//     });
//     $('.decr').each(function () {
//         $(this).on('click', function () {
//             decrItem(parseInt($($(this).siblings()[0]).attr('id')))
//         })
//     })
// }


// $.each(getItems(), function () {
//     var id = this.id;
//     $('#incr' + id).on('click', function () {
//         incrItem(id)
//     });
//     $('#decr' + id).on('click', function () {
//         decrItem(id)
//     })
// });

$('#form').submit(function () {
    var form = $(this);
    var items = getItems();
    items.forEach(function (val) {
        form.append($('<input type="hidden" name="frm[' + val.id + ']" value="' + val.count + '">'))
    });
    return true; // return false to cancel form action
});

$(window).on('resize', function () {
    if (window.innerWidth >= 992) {
        $('#bg-black').css({'display': 'none'});
        $('#mobile-cart-show').data('tg', 0);
        $('#shopping-cart-container').css({height: 'auto', overflow: 'visible'});
    } else {
        $('#shopping-cart-container').css({height: '60px'});
    }
});

function getResturantName(restaurant = null) {
    if (restaurant != null) {
        return restaurant
    }
    return (new URLSearchParams(location.search)).get('restaurant');
}

function hasAnyItem(restaurant = null) {
    return !!localStorage[getResturantName(restaurant)]
}

function getItems(restaurant = null) {
    if (hasAnyItem(restaurant)) {
        return JSON.parse(localStorage[getResturantName(restaurant)]);
    }
}

function getItemFromLocal(id, restaurant = null) {
    var items = getItems(restaurant);
    if (items && id) {
        // console.log(id);
        for (var i in items) {
            if (items[i].id === id) {
                // console.log(items[i])
                return items[i];
            }
        }
    }
    return false;
}

function getItemFromBasket(id) {
    return $('#' + id);
}

function setItemToLocal(id, title, price, count, restaurant = null) {
    var items = [];
    if (hasAnyItem(restaurant)) {
        items = getItems(restaurant);
    }
    items.push({
        id: id, title: title, price: price, count: count
    });
    updateItems(items, restaurant)
}

function setOrIncr(id, title, price, restaurant = null) {
    var thisItem = getItemFromLocal(id, restaurant);
    if (thisItem) {
        incrItem(id, restaurant)
    } else {
        setItemToLocal(id, title, price, 1, restaurant);
        setItemToBasket(id, title, price, 1)
    }
    updateItog();
}

function setItemToBasket(id, title, price, count) {
    $('#btn_oformit').css({display: 'block'});
    $('#clear-basket').css({display: 'block'});
    var li = $('<li class="list-group-item p-1 mb-2 border-0">');
    var row1 = $('<div class="row">');
    var foodName = $('<div class="col-6 col-lg-7">').html(title);
    var foodPrice = $('<div class="col-4 col-lg-3 font-weight-bold text-secondary">').html(price + 'c.');
    var foodRemove = $('<ion-icon style="cursor: pointer" class="text-danger remove-btn"  name="close"></ion-icon>');
    foodRemove.on('click', function () {
        removeItem(id);
    });
    row1.append(foodName);
    row1.append(foodPrice);
    row1.append($('<div class="col-2 col-lg-2 p-0 font-weight-bold">').html(foodRemove));

    li.append(row1);
    var row2 = $('<div class="row mt-1">');
    row2.append($('<div class="col-6" style="display: flex; overflow: hidden; align-items: center">').html('Количество :'));
    var btns = $('<div class="col-6 btn-group" role="group" aria-label="Basic example">');

    var decrBtn = $('<button type="button" class="btn">').html('-');
    btns.append(decrBtn);
    decrBtn.on('click', function () {
        decrItem(id)
    });
    btns.append($('<button type="button" id="' + id + '" class="btn bg-white">').html(count));

    var incrBtn = $('<button type="button" class="btn">').html('+');
    btns.append(incrBtn);
    incrBtn.on('click', function () {
        incrItem(id)
    });

    row2.append(btns);
    li.append(row2);
    var row3 = $('<div class="row mt-1 pb-1 border-bottom">');
    row3.append($('<div class="col-6 col-lg-2 col-xl-5">'));
    row3.append($('<div class="col-6 col-lg-10 col-xl-7 font-weight-bold text-danger" id="sum' + id + '">').html('Сумма : ' + (price * count).toFixed(2) + ' c.'));
    li.append(row3);
    cart.append(li);
    var itog = $('#itogo');
    itog.parent().css({display: 'block'});
    if (itog.text() == '') itog.text(0);
    itog.text((parseFloat(itog.text()) + price * count).toFixed(2));


}

function loadBasketItems() {
    var items = getItems();
    if (items) {
        items.forEach(function (value) {
            setItemToBasket(value.id, value.title, value.price, value.count)
        });
        return true
    }
    return false
}


function incrItem(id, restaurant = null) {
    var items = getItems(restaurant);
    var item = getItemFromLocal(id, restaurant);
    $.each(items, function () {
        if (this.id === item.id) {
            this.count++;
            if (restaurant === null) {
                $('#sum' + id).text('Сумма : ' + (this.count * this.price).toFixed(2) + ' c.');
                getItemFromBasket(id).text(this.count)
            }

        }
    });
    updateItems(items, restaurant);
    updateItog()
}


function decrItem(id) {
    var items = getItems();
    var item = getItemFromLocal(id);
    $.each(items, function () {
        if (this.id === item.id) {
            this.count--;
            if (this.count === 0) {
                this.count = 1
            }
            $('#sum' + id).text('Сумма : ' + (this.count * this.price).toFixed(2) + ' c.');
            getItemFromBasket(id).text(this.count)
        }
    });
    updateItems(items);
    updateItog()
}

function updateItog() {
    var itog = 0;
    var items = getItems();

    $.each(items, function () {
        itog += this.count * this.price
    });

    $('#itogo').text(parseFloat(itog +8 ).toFixed(2));
    $('#foodSum').text(parseFloat(itog).toFixed(2));
    $('#foodCount').text(items.length)
}

function removeItem(id) {
    var items = getItems();
    $.each(items, function (i) {
        if (this.id === id) {
            items.splice(i, 1)
        }
    });

    $('#' + id).parent().parent().parent().hide('slow', function () {
        this.remove();
        if (cart.children().length === 0) {
            $('#itogopar').fadeOut('slow');
            $('#btn_oformit').fadeOut('slow');
            $('#clear-basket').fadeOut('slow');
        }
    });


    updateItems(items);
    updateItog()
}

function updateItems(items, restaurant = null) {
    localStorage[getResturantName(restaurant)] = JSON.stringify(items)
}

