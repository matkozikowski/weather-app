
function addToCart(url, data) {
    return new Promise(function(resolve, reject){
        const request = new XMLHttpRequest();
        request.open('post', url);

        request.onload = function () {
            if (request.status == 200) {
                resolve(request.response);
                alert('Add To Cart');
            } else {
                reject(Error(request.statusText));
            }
        };

        request.send(data);
    })
}

let btnCartElements = document.querySelectorAll('.add--cart');

btnCartElements.forEach(function(btnCart) {
    btnCart.addEventListener('click', function(event) {
        const productId = event.currentTarget.getAttribute('data-product-id');

        if (productId) {
            addToCart('/cart/add', JSON.stringify({'product_id': productId }));
        }

    });
});

let clickEvent = new Event('click');
document.dispatchEvent(clickEvent);

