// get event from Iframe
window.onmessage = function (event) {
    if (event.data.type == "addToCart") {
        addToCart(event.data.productId);
        successAddToCart();
    }
}

// hit API to add prducts to cart
function addToCart(productId, qty = 1) {
    // Data to send
    const data = new URLSearchParams();
    data.append('product_id', productId);
    data.append('quantity', qty);

    // Configure the fetch request
    fetch('/?wc-ajax=add_to_cart', {
        method: 'POST',
        body: data,
    })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            throw new Error('Network response was not ok.');
        })
        .then(result => {
            console.log(result);
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });

}

// send event to Iframe
function successAddToCart() {
    const myIframe = document.getElementById("quizell-iframe");
    myIframe.contentWindow.postMessage({
        type: "successAddToCart",
    }, '*');
}
