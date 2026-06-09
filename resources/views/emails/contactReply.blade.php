@component('mail::message')
# Hello {{ $studentName }},

Thank you for reaching out to **UniSync**. An administrator has reviewed your inquiry and submitted a response to your message.

<div style="background-color: #14161d; border-left: 4px solid #9d5bfa; padding: 18px; margin: 20px 0; border-radius: 4px; color: #ffffff;">
    <strong style="color: #9d5bfa; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">Official Admin Response:</strong>
    <p style="margin: 0; font-size: 15px; line-height: 1.6; white-space: pre-wrap; color: #f1f5f9;">
        {{ $replyMessage }}
    </p>
</div>

---

### Your Original Subject Details:
<div style="font-size: 13px; color: #8a8f98; background-color: #f8fafc; border: 1px solid rgba(0,0,0,0.05); padding: 12px; border-radius: 6px; margin-top: 8px;">
    {{ $originalMessage }}
</div>

<br>

If you have any further questions or require additional assistance, please feel free to submit another form or reply directly back to this support stream thread.

Best regards,
**The UniSync Management Team**
@endcomponent