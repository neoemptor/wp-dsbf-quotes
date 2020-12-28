<?php
function dsbf_show_form_shortcode() {
	?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <div class="qandc-container">
        <div class="tab">
            <button class="tablinks active" onclick="formType = CONTACT; displayForm(event, 'client-quote');">Contact</button>
            <button class="tablinks" onclick="formType = QUOTE; displayForm(event, 'quote-section');">Quote</button>
        </div>
        <div class="form-container">
            <div class="quote-form-container">
                <form id="client-quote" class="tabcontent">
                    <label for="full-name">Full Name *</label>
                    <input type="text" id="full-name" required>

                    <label for="email">Email *</label>
                    <input type="email" id="email" required>

                    <label for="phone">Phone *</label>
                    <input type="tel" id="phone" required>

                    <label for="subject">Subject *</label>
                    <input type="text" id="subject" required>

                    <label for="comment">Comment *</label>
                    <textarea id="comment" required></textarea>

                    <button type="submit" id="submit-quote">Send</button>
                </form>
                <div id="quote-section" class="tabcontent">
                    <div class="quote-list-header-container">
                        <div class="quote-list-header">Item</div>
                        <div class="quote-list-header">Code</div>
                        <div class="quote-list-header">Book</div>
                        <div class="quote-list-header">Page No</div>
                        <div class="quote-list-header">Qty</div>
                    </div>
                    <div class="quote-list-container">
                        <div class="quote-list-item"><input id="item-0" type="text" placeholder="Item"></div>
                        <div class="quote-list-item"><input id="code-0" type="text" placeholder="Code"></div>
                        <div class="quote-list-item"><textarea
                                    id="book-0"
                                    type="text"
                                    placeholder="Book"
                                    rows="1"
                                    cols="50"
                            ></textarea></div>
                        <div class="quote-list-item"><input id="page-no-0" type="text" placeholder="Page No"></div>
                        <div class="quote-list-item"><input id="quantity-0" type="text" placeholder="Quantity"></div>
                    </div>
                    <button class="quote-item-add-button">Add</button>
                    <button class="quote-item-delete-button">Delete</button>
                </div>
            </div>
        </div>
    </div>
	<?php
}
