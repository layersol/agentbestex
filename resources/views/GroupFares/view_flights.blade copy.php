@include('layouts.header')

<div class="bodyload" style="margin-top:80px;display:none">
 <div class="rotatingDiv"></div>
</div>

<main>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body {
  font-family: "Poppins", sans-serif;
  background: #f5f6fa;
  margin: 20px;
}

.flight-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  overflow: hidden;
  max-width: 1100px;
  margin: auto;
  margin-bottom: 20px;
}

.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 24px;
  border-bottom: 1px solid #eee;
}

.airline {
  display: flex;
  align-items: center;
  gap: 10px;
}

.airline img {
  width: 100px;
}

.flight-info {
  text-align: center;
}

.flight-info h6 {
  margin: 0;
  font-size: 16px;
  font-weight: 600;
}

.flight-info span {
  font-size: 14px;
  color: #777;
}

.price {
  text-align: right;
}

.price p {
  margin: 0;
  font-size: 22px;
  color: #e60000;
  font-weight: 600;
}

.price small {
  display: block;
  color: #555;
  margin-top: 4px;
}

.select-btn {
  background: #007bff;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 6px;
}

.toggle-details {
  text-align: right;
  padding: 10px 24px;
  font-weight: 500;
  cursor: pointer;
  color: #007bff;
  border-top: 1px solid #eee;
}

.toggle-details i {
  margin-left: 6px;
  transition: transform 0.3s;
}

.details {
  display: none;
  padding: 20px;
  flex-wrap: wrap;
  transition: all 0.3s ease-in-out;
}

.details.show {
  display: flex;
}

.details-left {
  flex: 1;
  min-width: 350px;
}

.details-right {
  flex: 1;
  min-width: 300px;
  border-left: 1px solid #eee;
  padding-left: 20px;
}

.details-left h4 {
  margin-bottom: 8px;
}

.price-list {
  margin-top: 10px;
}

.price-list p {
  font-size: 15px;
  margin: 5px 0;
}

.counter {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 10px 0;
}

.counter button {
  width: 32px;
  height: 32px;
  border: none;
  color: white;
  font-size: 18px;
  border-radius: 6px;
  cursor: pointer;
}

.counter button.minus { background: #d9534f; }
.counter button.plus { background: #5cb85c; }

.counter input {
  width: 50px;
  text-align: center;
  border: none;
  font-size: 16px;
  background: #f3f3f3;
  border-radius: 6px;
}

.total {
  font-size: 22px;
  color: #e60000;
  font-weight: bold;
  text-align: right;
  margin-top: 10px;
}

.book-btn {
  background: #e60000;
  color: white;
  border: none;
  width: 100%;
  padding: 12px;
  border-radius: 6px;
  font-size: 18px;
  margin-top: 10px;
  cursor: pointer;
}

.flight-grid {
  display: grid;
  grid-template-columns: 1.5fr 1.5fr 1.5fr 1.5fr 2fr;
  align-items: center;
  gap: 10px;
  padding: 15px 20px;
  background: #fff;
}

.flight-grid .col {
  text-align: center;
}

.airline {
  display: flex;
  align-items: center;
  gap: 10px;
}

.route h6 {
  margin: 0;
  font-size: 16px;
  color: #222;
}

.duration {
  text-align: center;
}

.availability p {
  margin: 0;
}
.available {
  color: #2ecc71;
  font-weight: bold;
}
.not-available {
  color: #e74c3c;
  font-weight: bold;
}

.price {
  text-align: right;
}
.price p {
  font-size: 18px;
  margin: 0 0 5px 0;
  font-weight: bold;
}
.select-btn {
  background: #007bff;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 6px 12px;
  cursor: pointer;
  font-size: 14px;
}
.select-btn:hover {
  background: #0056b3;
}
.empty
{
  padding: 20px;
  text-align: center;
}
</style>



<?php if (empty($result)): ?>
  <div class="empty">No flights found for your search.</div>
<?php else: ?>
  <?php foreach ($result as $row): ?>




    
  <div class="flight-card">
   <div class="flight-grid">
    <!-- 1️⃣ Airline -->
    <div class="col airline">

      <div>
              <img src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/<?=$row['airline_code']?>.svg" alt="logo"><br>
        <strong><?=$row['airline_name']?></strong><br>
        <small><?=$row['airline_code']?>-<?=$row['number']?></small>
      </div>
    </div>

    <!-- 2️⃣ Route Info -->
    <div class="col route">
      <h6><?= strtoupper($row['departure_airport']) ?>  ( <?= strtoupper($row['departure_airport_name']) ?> ) </h6>
    
          <h3><?= date('h:i A', strtotime($row['departure_time'])) ?></h3>

      <small><?=$row['departure_date']?></small><br>
    
    </div>

    <!-- 3️⃣ Duration -->
    <div class="col duration">
      
      
 
        
      <?php
$departure = new DateTime($row['departure_time']);
$arrival = new DateTime($row['arrival_time']);

$interval = $departure->diff($arrival);
$duration = $interval->format('%h hr %i min');
?>


<i class="fa-regular fa-clock"></i> <?= $duration ?>
   
      <hr style="border-top: 1px solid #9f9f9f;
    height: 0px;
    margin: 0px;"><i class="fa-solid fa-suitcase-rolling"></i>
   <?=$row['baggaes']?> KG
 
    </div>

    <!-- 4️⃣ Availability -->
    <div class="col availability">
       <h6><?= strtoupper($row['arrival_airport']) ?> ( <?= strtoupper($row['arrival_airport_name']) ?> ) </h6>
  
      
     <h3><?= date('h:i A', strtotime($row['arrival_time'])) ?></h3>

    <small><?=$row['departure_date']?></small><br>
    </div>

    <!-- 5️⃣ Price + Button -->
    <div class="col price">
       <p><strong><?=$row['currency']?> <?=number_format($row['adult_price'], 2)?></strong></p>
      
     <?=$row['seats']?> seats left
     <br>
  (<?=$row['status'] == 'YES' ? 'available' : 'not-available'?>)
       <input type="hidden" id="seatAvailable<?=$row['id']?>" value="<?=$row['seats']?>">

      
     <!-- <button class="select-btn">BOOK NOW</button> -->

    </div>




  </div>

    <div class="toggle-details" onclick="toggleDetails(this)">
      Details <i class="fa fa-chevron-down"></i>
    </div>

    <div class="details">
      <div class="details-left">
        <h4>Flight Details</h4>
        <p><strong>Departure:</strong>  (<?=strtoupper($row['departure_airport'])?>) – <?=$row['departure_date']?>, <?=date('H:i:A', strtotime($row['departure_time']))?></p>
        <p><strong>Arrival:</strong>  (<?=strtoupper($row['arrival_airport'])?>) – <?=$row['arrival_date'] ?? $row['departure_date']?>, <?=date('H:i:A', strtotime($row['arrival_time']))?></p>

        <div class="price-list">
          <p>Adult: <?=$row['currency']?> <span id="adultPrice<?=$row['id']?>"><?=$row['adult_price']?></span></p>
          <p>Child: <?=$row['currency']?> <span id="childPrice<?=$row['id']?>"><?=$row['child_price']?></span></p>
          <p>Infant: <?=$row['currency']?> <span id="infantPrice<?=$row['id']?>"><?=$row['infant_price']?></span></p>
        </div>
      </div>

      <div class="details-right">
        <div class="counter">
          <span>Adult</span>
          <div>
            <button class="minus" onclick="updateCount(<?=$row['id']?>, 'adult', -1)">-</button>
            <input type="text" id="adultCount<?=$row['id']?>" value="1" readonly>
            <button class="plus" onclick="updateCount(<?=$row['id']?>, 'adult', 1)">+</button>
          </div>
        </div>

        <div class="counter">
          <span>Child</span>
          <div>
            <button class="minus" onclick="updateCount(<?=$row['id']?>, 'child', -1)">-</button>
            <input type="text" id="childCount<?=$row['id']?>" value="0" readonly>
            <button class="plus" onclick="updateCount(<?=$row['id']?>, 'child', 1)">+</button>
          </div>
        </div>

        <div class="counter">
          <span>Infant</span>
          <div>
            <button class="minus" onclick="updateCount(<?=$row['id']?>, 'infant', -1)">-</button>
            <input type="text" id="infantCount<?=$row['id']?>" value="0" readonly>
            <button class="plus" onclick="updateCount(<?=$row['id']?>, 'infant', 1)">+</button>
          </div>
        </div>

        <div class="total"><?=$row['currency']?> <span id="totalFare<?=$row['id']?>"><?=number_format($row['adult_price'], 2)?></span></div>
        
        <form method="POST" action="{{ route('book.flight') }}">
  @csrf

  <!-- Hidden fields to send data -->
  <input type="hidden" name="flight" value='<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>'>

  <input type="hidden" name="flight_id" value="<?=$row['id']?>">
  <input type="hidden" name="adult_count" id="adultInput<?=$row['id']?>" value="1">
  <input type="hidden" name="child_count" id="childInput<?=$row['id']?>" value="0">
  <input type="hidden" name="infant_count" id="infantInput<?=$row['id']?>" value="0">
  <input type="hidden" name="total_fare" id="fareInput<?=$row['id']?>" value="<?=number_format($row['adult_price'], 2)?>">

  <button type="submit" class="book-btn">BOOK NOW</button>
</form>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
<?php endif; ?>

<script>
function toggleDetails(el) {
 const details = el.nextElementSibling;
  const icon = el.querySelector("i");
  const card = el.closest(".flight-card");
  const bookBtn = card.querySelector(".book-toggle-btn"); // Find the top "BOOK NOW" button

  // Toggle details
  details.classList.toggle("show");
  icon.style.transform = details.classList.contains("show") ? "rotate(180deg)" : "rotate(0deg)";

  // Hide or show the BOOK NOW button
  if (details.classList.contains("show")) {
    bookBtn.style.display = "none";  // hide when details open
  } else {
    bookBtn.style.display = "inline-block"; // show again when closed
  }
}

function updateCount(id, type, change) {
    const adultInput = document.getElementById("adultCount" + id);
    const childInput = document.getElementById("childCount" + id);
    const infantInput = document.getElementById("infantCount" + id);

    let adult = parseInt(adultInput.value);
    let child = parseInt(childInput.value);
    let infant = parseInt(infantInput.value);

    const seatsLeft = parseInt(document.getElementById("seatAvailable" + id).value);

    // Calculate new count for the clicked type
    let newCount = 0;
    if (type === 'adult') newCount = adult + change;
    if (type === 'child') newCount = child + change;
    if (type === 'infant') newCount = infant + change;

    // Prevent negative values
    if (newCount < 0) newCount = 0;

    // Total adult + child
    let totalAdultChild = (type === 'adult' ? newCount : adult) + (type === 'child' ? newCount : child);

    // Ensure total adult + child ≤ available seats
    if (totalAdultChild > seatsLeft) {
        newCount = (type === 'adult' ? seatsLeft - child : seatsLeft - adult);
        totalAdultChild = seatsLeft;
    }

    // Ensure infants ≤ adults
    if (type === 'infant' && newCount > adult) {
        newCount = adult;
    }
    if (type === 'adult' && newCount < infant) {
        infantInput.value = newCount;
        infant = newCount;
    }

    // Update the correct input
    if (type === 'adult') adultInput.value = newCount;
    if (type === 'child') childInput.value = newCount;
    if (type === 'infant') infantInput.value = newCount;

    // Disable plus buttons when limits reached
    const totalPassengers = parseInt(adultInput.value) + parseInt(childInput.value);
    ['adult', 'child'].forEach(t => {
        const btnPlus = document.getElementById(t + "Count" + id).nextElementSibling;
        btnPlus.disabled = totalPassengers >= seatsLeft;
    });
    // Infant plus button disabled if infant >= adults
    const infantPlus = document.getElementById("infantCount" + id).nextElementSibling;
    infantPlus.disabled = parseInt(infantInput.value) >= parseInt(adultInput.value);

    calculateTotal(id);
}



function calculateTotal(id) {
  const adult = parseInt(document.getElementById("adultCount" + id).value);
  const child = parseInt(document.getElementById("childCount" + id).value);
  const infant = parseInt(document.getElementById("infantCount" + id).value);
  const adultPrice = parseFloat(document.getElementById("adultPrice" + id).textContent);
  const childPrice = parseFloat(document.getElementById("childPrice" + id).textContent);
  const infantPrice = parseFloat(document.getElementById("infantPrice" + id).textContent);
  const total = (adult * adultPrice) + (child * childPrice) + (infant * infantPrice);
  document.getElementById("totalFare" + id).textContent = total.toLocaleString("en-IN", {minimumFractionDigits: 2});
}


document.querySelectorAll('.book-btn').forEach(button => {
  button.addEventListener('click', function (e) {
    const form = this.closest('form');
    const id = form.querySelector('input[name="flight_id"]').value;
    const flight = form.querySelector('input[name="flight"]').value;

   
    // Sync visible counters to hidden inputs
    form.querySelector("#adultInput" + id).value = document.getElementById("adultCount" + id).value;
    form.querySelector("#childInput" + id).value = document.getElementById("childCount" + id).value;
    form.querySelector("#infantInput" + id).value = document.getElementById("infantCount" + id).value;

    // Sync total fare
    form.querySelector("#fareInput" + id).value = document.getElementById("totalFare" + id).textContent;
  });
});

</script>

</main>

@include('layouts.footer')
