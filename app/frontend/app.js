const API_URL = "http://localhost:8000";

const form = document.getElementById("deliveryForm");
const deliveryList = document.getElementById("deliveryList");

async function loadDeliveries() {

    const response = await fetch(API_URL);

    const deliveries = await response.json();

    deliveryList.innerHTML = "";

    deliveries.forEach(delivery => {

        const div = document.createElement("div");

        div.classList.add("delivery");

        div.innerHTML = `
            <div class="wrapper">
                <h3>${delivery.customer_name}</h3>
                <p>Pedido #${delivery.order_id}</p>
            </div>
            
            <p>${delivery.address}</p>

            <select onchange="updateStatus(${delivery.id}, this.value)">
                <option ${delivery.status === 'Pendente' ? 'selected' : ''}>
                    Pendente
                </option>

                <option ${delivery.status === 'Em rota' ? 'selected' : ''}>
                    Em rota
                </option>

                <option ${delivery.status === 'Entregue' ? 'selected' : ''}>
                    Entregue
                </option>
            </select>

            <a onclick="removeDelivery(${delivery.id})">Remover</a>
        `;

        deliveryList.appendChild(div);
    });
}

form.addEventListener("submit", async (e) => {

    e.preventDefault();

    const customer_name =
        document.getElementById("customer_name").value;

    const order_id =
        document.getElementById("order_id").value;

    const address =
        document.getElementById("address").value;

    await fetch(API_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            customer_name,
            order_id,
            address
        })
    });

    form.reset();

    loadDeliveries();
});

async function updateStatus(id, status) {

    await fetch(`${API_URL}?id=${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ status })
    });

    loadDeliveries();
}

async function removeDelivery(id) {

    await fetch(`${API_URL}?id=${id}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        }
    });

    loadDeliveries();
}

loadDeliveries();
