const stripe = Stripe(stripePublickey);

const elements = stripe.elements();
const card = elements.create("card");

card.mount("#card-element");
card.on("change", function (event) {
    document.querySelector("button").disabled = event.empty;
    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
});

const form = document.getElementById("payment-form");

form.addEventListener("submit", function (event) {
    event.preventDefault();

    stripe.confirmCardPayment(clientSecret, {
        payment_method: {
        card: card
          }
        })
        .then(function(result) {
        if (result.error) {
        console.log(result.error.message);
         } else {
            // the payment success 
            window.location.href = redirectAfterSuccessUrl;
            }
            });
        });