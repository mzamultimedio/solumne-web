import './bootstrap';

import Alpine from 'alpinejs';
import collapse from './plugins/collapse.js';

window.Alpine = Alpine;

Alpine.plugin(collapse);

document.addEventListener('alpine:init', () => {
    Alpine.data('aiAssistant', () => ({
        open: false,
        input: '',
        loading: false,
        thinkingDots: 1,
        thinkingInterval: null,
        messages: [],

        init() {
            // Sin mensaje inicial - mostramos sugerencias en su lugar
            this.messages = [];
        },

        toggle() {
            this.open = !this.open;

            if (this.open) {
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        sendQuickQuestion(question) {
            this.input = question;
            this.send();
        },

        async send() {
            if (this.loading) {
                return;
            }

            const text = this.input.trim();

            if (!text) {
                return;
            }

            this.pushMessage('user', text);
            this.input = '';
            this.loading = true;
            this.startThinking();

            try {
                const response = await fetch('/ai/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken(),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ message: text }),
                });

                if (!response.ok) {
                    throw new Error(`Request failed with status ${response.status}`);
                }

                const data = await response.json();

                this.pushMessage('assistant', data.reply ?? 'No pude procesar tu solicitud en este momento.');
            } catch (error) {
                console.error('AI chat error', error);
                this.pushMessage('assistant', 'Estoy teniendo problemas para responder. Intenta nuevamente en unos segundos.');
            } finally {
                this.loading = false;
                this.stopThinking();
            }
        },

        async pushMessage(role, text) {
            const id = crypto.randomUUID ? crypto.randomUUID() : Date.now() + Math.random();
            const baseMessage = {
                id,
                role,
                text,
                animatedText: role === 'assistant' ? '' : text,
            };

            this.messages.push(baseMessage);

            if (role === 'assistant') {
                await this.animateMessage(id, text);
            }

            this.$nextTick(() => this.scrollToBottom());
        },

        scrollToBottom() {
            if (this.$refs.messages) {
                this.$refs.messages.scrollTo({
                    top: this.$refs.messages.scrollHeight,
                    behavior: 'smooth',
                });
            }
        },

        async animateMessage(id, fullText) {
            const steps = [...fullText];
            const speed = fullText.length > 0 ? Math.min(50, Math.max(15, 1200 / fullText.length)) : 40;

            for (let i = 0; i < steps.length; i++) {
                const message = this.messages.find((msg) => msg.id === id);

                if (!message) {
                    break;
                }

                message.animatedText = (message.animatedText ?? '') + steps[i];
                await new Promise((resolve) => setTimeout(resolve, speed));
            }
        },

        csrfToken() {
            const token = document.querySelector('meta[name="csrf-token"]');

            if (!token) {
                console.warn('CSRF token not found. Ensure meta tag is present.');
                return '';
            }

            return token.getAttribute('content');
        },

        startThinking() {
            this.thinkingDots = 1;

            if (this.thinkingInterval) {
                clearInterval(this.thinkingInterval);
            }

            this.thinkingInterval = setInterval(() => {
                this.thinkingDots = this.thinkingDots === 3 ? 1 : this.thinkingDots + 1;
            }, 400);
        },

        stopThinking() {
            if (this.thinkingInterval) {
                clearInterval(this.thinkingInterval);
                this.thinkingInterval = null;
            }

            this.thinkingDots = 1;
        },
    }));
});

Alpine.start();
