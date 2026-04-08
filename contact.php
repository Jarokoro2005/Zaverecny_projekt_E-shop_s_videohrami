<?php
include_once("functions.php");
?>

<?php require("parts/header.php"); ?>

<!-- NAV will go here -->

<?php require("parts/nav.php"); ?>

<div class="container">
  <div class="page-header">
    <p class="page-header__eyebrow">// We are here for you</p>
    <h1 class="page-header__title">Get in <span>Touch</span></h1>
  </div>

  <section class="contact-section">
    <div class="contact-grid">
      <!-- Left: info -->
      <div class="contact-info">
        <p class="contact-intro">
          Whether you have a question about an order, need help with a game
          key, or just want to say hello — our team is ready. We typically
          respond within 24 hours on business days.
        </p>

        <div class="contact-items">
          <div class="contact-item">
            <div class="contact-item__icon">✉</div>
            <div>
              <p class="contact-item__label">Email</p>
              <p class="contact-item__value">support@gamevault.example</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item__icon">💬</div>
            <div>
              <p class="contact-item__label">Live Chat</p>
              <p class="contact-item__value">
                Available Mon–Fri, 9 AM–6 PM UTC
              </p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item__icon">📍</div>
            <div>
              <p class="contact-item__label">Headquarters</p>
              <p class="contact-item__value">
                New Arcadia Digital HQ (Remote-first)
              </p>
            </div>
          </div>
        </div>

        <p class="contact-social-title">Follow Us</p>
        <div class="contact-social-links">
          <a href="#" class="social-link" aria-label="Twitter/X">𝕏</a>
          <a href="#" class="social-link" aria-label="Discord">🎮</a>
          <a href="#" class="social-link" aria-label="YouTube">▶</a>
          <a href="#" class="social-link" aria-label="Twitch">📺</a>
          <a href="#" class="social-link" aria-label="Instagram">📷</a>
        </div>
      </div>

      <!-- Right: form -->
      <div class="contact-form-wrap">
        <h2 class="contact-form-title">Send a Message</h2>
        <p class="contact-form-subtitle">// Fields marked * are required</p>

        <form class="contact-form" id="contactForm" novalidate>
          <div class="form-feedback" role="alert" aria-live="polite"></div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="contact-name">Full Name *</label>
              <input class="form-control" type="text" id="contact-name" name="name" placeholder="Your name"
                autocomplete="name" required />
            </div>
            <div class="form-group">
              <label class="form-label" for="contact-email">Email Address *</label>
              <input class="form-control" type="email" id="contact-email" name="email" placeholder="you@example.com"
                autocomplete="email" required />
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="contact-order">Order ID
              <span style="color: var(--muted)">(optional)</span></label>
            <input class="form-control" type="text" id="contact-order" name="order_id"
              placeholder="e.g. GV-2025-00492" />
          </div>

          <div class="form-group">
            <label class="form-label" for="contact-topic">Topic *</label>
            <select class="form-control" id="contact-topic" name="topic" required>
              <option value="" disabled selected>Select a topic…</option>
              <option value="order">Order &amp; Payment</option>
              <option value="key">Game Key Issue</option>
              <option value="technical">Technical Issue</option>
              <option value="refund">Refund Request</option>
              <option value="account">Account Problem</option>
              <option value="partnership">Partnership / Press</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="contact-message">Message *</label>
            <textarea class="form-control" id="contact-message" name="message"
              placeholder="Describe your issue or question in as much detail as possible…" maxlength="1000"
              required></textarea>
            <span class="char-counter">0 / 1000</span>
          </div>

          <div class="filter-item" style="padding: 0.2rem 0">
            <input type="checkbox" id="newsletter" name="newsletter" value="1" />
            <label for="newsletter" style="font-size: 0.85rem; color: var(--muted)">
              Subscribe to GameVault news and exclusive deals
            </label>
          </div>

          <div class="form-submit">
            <button type="submit" class="btn btn-solid">
              <span>⚡ Send Message</span>
            </button>
            <p class="form-note">
              We never share your data. See our&nbsp;<a href="#" style="color: var(--cyan)">Privacy Policy</a>.
            </p>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq-section">
    <h2 class="section-title">Frequently Asked <span>Questions</span></h2>
    <div class="section-line"></div>
    <div class="faq-grid">
      <div class="faq-item">
        <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
          How do I receive my game after purchase?
          <span class="faq-icon" aria-hidden="true">+</span>
        </div>
        <div class="faq-answer">
          Your game key and download link are delivered instantly to your
          registered email address and appear in your GameVault account
          library.
        </div>
      </div>
      <div class="faq-item">
        <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
          What is your refund policy?
          <span class="faq-icon" aria-hidden="true">+</span>
        </div>
        <div class="faq-answer">
          We offer a 14-day refund window for unactivated keys. Activated
          keys are non-refundable, but we handle disputes case-by-case —
          just reach out to support.
        </div>
      </div>
      <div class="faq-item">
        <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
          Are the game keys region-locked?
          <span class="faq-icon" aria-hidden="true">+</span>
        </div>
        <div class="faq-answer">
          Each product page clearly states whether a key is global or
          region-specific. Most of our catalogue is globally compatible.
        </div>
      </div>
      <div class="faq-item">
        <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
          How do I report a technical issue?
          <span class="faq-icon" aria-hidden="true">+</span>
        </div>
        <div class="faq-answer">
          Use the contact form on this page, select "Technical Issue" as the
          topic, and provide as much detail as possible. Our team typically
          responds within 24 hours.
        </div>
      </div>
      <div class="faq-item">
        <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
          Can I gift games to a friend?
          <span class="faq-icon" aria-hidden="true">+</span>
        </div>
        <div class="faq-answer">
          Yes! During checkout select "Buy as Gift" and enter your friend's
          email address.
        </div>
      </div>
      <div class="faq-item">
        <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
          Do you offer student or bundle discounts?
          <span class="faq-icon" aria-hidden="true">+</span>
        </div>
        <div class="faq-answer">
          We run regular bundle promotions on the Shop page. For student
          discounts, contact support with valid student ID documentation.
        </div>
      </div>
    </div>
  </section>
</div>

<!-- FOOTER will go here -->
<?php include("parts/footer.php"); ?>

<script src="js/main.js"></script>
</body>

</html>