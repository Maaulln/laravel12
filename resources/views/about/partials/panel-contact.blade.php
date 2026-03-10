{{-- Panel: Contact --}}
<div id="panel-contact" class="panel">
    <div class="section-header">COMMUNICATION CHANNELS</div>

    <div class="contact-grid">
        <x-portfolio.contact-card
            icon="📧"
            label="EMAIL"
            value="maaullntech@gmail.com"
            href="mailto:maaullntech@gmail.com"
        />

        <x-portfolio.contact-card
            icon="📱"
            label="PHONE"
            value="+62 821 4148 2282"
            href="tel:6282141482282"
        />

        <x-portfolio.contact-card
            icon="🌐"
            label="WEBSITE"
            value="maulanachandrairawan<br>.framer.website"
            href="https://maulanachandrairawan.framer.website"
        />

        <x-portfolio.contact-card
            icon="📍"
            label="LOCATION"
            value="Malang, East Java<br>Indonesia"
        />
    </div>

    {{-- Send Message Button --}}
    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ url('/contact') }}" class="btn-retro btn-submit" style="display: inline-block; text-decoration: none;">
            <span class="btn-icon">📤</span> SEND MESSAGE
        </a>
    </div>
</div>
