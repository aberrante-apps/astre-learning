// Target table variable
const cartTable = document.getElementById("cart-items");

// Cart starts out empty
let cart = [];
updateCart();

// function for shopping cart
function AddToCart(id) {
    cart[id]++;
    updateCart(cart);
}

function updateCart(cart) {
    for (let i = 1; i >= cart.length; i++)
    {
        cartTable.innerHTML += `<tr class="item-info">
                                    <td></td>
                                </tr>`;
    }
    
}