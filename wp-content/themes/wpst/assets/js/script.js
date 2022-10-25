
// var items = [];
var cart = $('#shopping-cart');
var foods = $('.to-basket');
var hasItem = setBasketItems(getItems(restaurantName));


foods.each(function (index) {
    food = $(this);
    food.on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var title = $(this).data('title');
        var price = $(this).data('price');
        
        
        
        var thisItem = getItem(id, getItems(restaurantName));

        // console.log(thisItem);

        if (thisItem) {
            thisItem.count++;
        } else {
            createfoodItem(title, price, 1, id);
            setItemToLocal(id, title, price)
        }
    })
});

function incrItem(id, items) {

}

function createfoodItem(title, price, count, id) {
    var li = $('<li class="list-group-item p-1 mb-2 border-0">');
    var row1 = $('<div class="row">');
    var foodName = $('<div class="col-md-6 col-lg-8">').html(title);
    var foodPrice = $('<div class="col-md-6 col-lg-4 font-weight-bold text-secondary">').html(price + 'c.');
    row1.append(foodName);
    row1.append(foodPrice);
    li.append(row1);
    var row2 = $('<div class="row mt-1">');
    row2.append($('<div class="col-md-6" style="display: flex; align-items: center">').html('Количество :'));
    var btns = $('<div class="col-md-6 btn-group" role="group" aria-label="Basic example">');
    btns.append($('<button type="button" id="incr" class="btn ">').html('-'));
    btns.append($('<button type="button" id="id' + id + '" class="btn bg-white">').html(count));
    btns.append($('<button type="button" id="decr" class="btn ">').html('+'));
    row2.append(btns);
    li.append(row2);
    var row3 = $('<div class="row mt-1 pb-1 border-bottom">');
    row3.append($('<div class="col-lg-2 col-xl-5">'));
    row3.append($('<div class="col-lg-11 col-xl-7 font-weight-bold text-danger">').html('Сумма : ' + (price * count).toFixed(2) + ' c.'));
    li.append(row3);
    cart.append(li);
    var itog = $('#itogo')
   
    itog.parent().css({display: 'block'})
    if (itog.text() === '') itog.text(0)
    itog.text((parseFloat(itog.text()) + price * count ).toFixed(2));

}

// function getItems(restaurantName) {
//     if (localStorage[restaurantName]) {
//         items = JSON.parse(localStorage[restaurantName]);
//         items.forEach(function (value) {
//             createfoodItem(value.title, value.price, value.count, value.id)
//         });
//         return true
//     } else {
//         localStorage[restaurantName] = [];
//         return false
//     }
// }

function getItems(restaurantName) {
    if (localStorage[restaurantName]) {
        return JSON.parse(localStorage[restaurantName]);
    }
}

function getItem(id, items) {
    if (items && id) {
        for (var i in items) {
            if (items[i].id === id) {
                return items[i];
            }
        }
    }
    return false;
}

function setItemsToLocal(items) {
    localStorage[restaurantName] = JSON.stringify(items)
}

function setItemToLocal(id, title, price) {
    items = getItems(restaurantName);
    if (!items) {
        items = []
    }
    items.push({
        id: id,
        title: title,
        price: price,
        count: 1
    });

}

function setBasketItems(items) {
    if (items) {
        items.forEach(function (value) {
            createfoodItem(value.title, value.price, value.count, value.id)
        });
        return true
    }
    return false
}


window.on('scroll', function () {
    console.log(this.weight)
});

var cardWrap = $('.shopping-cart-wrapper');

console.log(cardWrap.height());


