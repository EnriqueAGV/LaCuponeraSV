// Formato automático y validación en vivo de los formularios.
// Las reglas replican las de app/Core/Validator.php. El servidor sigue validando al enviar.
(function () {
    'use strict';

    // Grupos de dígitos separados por guion: NIT ####-######-###-#, DUI ########-#, teléfono ####-####.
    const MASKS = {
        nit: [4, 6, 3, 1],
        dui: [8, 1],
        phone: [4, 4],
    };

    const MESSAGES = {
        required: 'Este campo es obligatorio.',
        email: 'Ingresa un correo electrónico válido.',
        username: 'Usa de 4 a 20 caracteres: letras, números, punto o guion bajo.',
        password: 'La contraseña debe tener al menos 8 caracteres, con una letra y un número.',
        nit: 'El NIT debe tener el formato ####-######-###-#.',
        dui: 'El DUI debe tener el formato ########-#.',
        phone: 'El teléfono debe tener el formato ####-####.',
        date: 'Ingresa una fecha válida.',
        adult: 'Debes tener al menos 18 años.',
        same: 'Las contraseñas no coinciden.',
    };

    const CHECKS = {
        email: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
        username: (v) => /^[A-Za-z0-9_.]{4,20}$/.test(v),
        password: (v) => /^(?=.*[A-Za-z])(?=.*\d).{8,}$/.test(v),
        nit: (v) => /^\d{4}-?\d{6}-?\d{3}-?\d$/.test(v),
        dui: (v) => /^\d{8}-?\d$/.test(v),
        phone: (v) => /^\d{4}-?\d{4}$/.test(v),
        date: (v) => parseDate(v) !== null,
        adult: (v) => {
            const birth = parseDate(v);
            if (birth === null) return false;
            const limit = new Date();
            limit.setFullYear(limit.getFullYear() - 18);
            return birth <= limit;
        },
        same: (v, arg, form) => v === (form.elements[arg] ? form.elements[arg].value.trim() : ''),
    };

    function parseDate(value) {
        const match = /^(\d{4})-(\d{2})-(\d{2})$/.exec(value);
        if (!match) return null;

        const [year, month, day] = [Number(match[1]), Number(match[2]), Number(match[3])];
        const date = new Date(year, month - 1, day);
        const valid = date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day;

        return valid ? date : null;
    }

    // Devuelve el mensaje del primer error del campo, o cadena vacía si es válido.
    function errorFor(input) {
        const value = input.value.trim();
        const rules = (input.dataset.rules || '').split('|').filter(Boolean);

        for (const rule of rules) {
            const [name, arg] = rule.split(':');

            if (name === 'required') {
                if (value === '') return MESSAGES.required;
                continue;
            }

            if (value !== '' && CHECKS[name] && !CHECKS[name](value, arg, input.form)) {
                return MESSAGES[name];
            }
        }

        return '';
    }

    function showError(input, message) {
        const field = input.closest('.field');
        if (!field) return;

        const existing = field.querySelector('.field-error');

        if (message === '') {
            if (existing) existing.remove();
            input.classList.remove('is-invalid');
            input.removeAttribute('aria-invalid');
            return;
        }

        const element = existing || document.createElement('small');
        element.className = 'field-error';
        element.textContent = message;
        if (!existing) field.appendChild(element);

        input.classList.add('is-invalid');
        input.setAttribute('aria-invalid', 'true');
    }

    // Deja solo dígitos, agrega los guiones y mantiene la posición del cursor.
    function applyMask(input, groups) {
        const total = groups.reduce((sum, size) => sum + size, 0);
        const caret = input.selectionStart ?? input.value.length;
        const digitsBeforeCaret = input.value.slice(0, caret).replace(/\D/g, '').length;
        const digits = input.value.replace(/\D/g, '').slice(0, total);

        let formatted = '';
        let index = 0;

        for (const size of groups) {
            const part = digits.slice(index, index + size);
            if (part === '') break;

            formatted += (formatted ? '-' : '') + part;
            index += size;
        }

        input.value = formatted;

        let position = 0;
        let seen = 0;
        while (position < formatted.length && seen < digitsBeforeCaret) {
            if (/\d/.test(formatted[position])) seen++;
            position++;
        }
        input.setSelectionRange(position, position);
    }

    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', (event) => {
            let firstInvalid = null;

            form.querySelectorAll('[data-rules]').forEach((input) => {
                const message = errorFor(input);
                showError(input, message);

                if (message !== '' && firstInvalid === null) {
                    firstInvalid = input;
                }
            });

            if (firstInvalid !== null) {
                event.preventDefault();
                firstInvalid.focus();
            }
        });
    });

    document.querySelectorAll('[data-rules]').forEach((input) => {
        const mask = input.dataset.mask;

        if (mask && MASKS[mask]) {
            input.addEventListener('input', () => applyMask(input, MASKS[mask]));
        }

        // Al escribir solo se revisa un campo que ya tiene error; así el mensaje desaparece al corregirlo.
        input.addEventListener('input', () => {
            if (input.classList.contains('is-invalid')) {
                showError(input, errorFor(input));
            }

            // Si cambia la contraseña, también se revisa su confirmación.
            if (input.name === 'password' && input.form && input.form.elements.password_confirmation) {
                const confirmation = input.form.elements.password_confirmation;
                if (confirmation.value !== '' || confirmation.classList.contains('is-invalid')) {
                    showError(confirmation, errorFor(confirmation));
                }
            }
        });

        input.addEventListener('blur', () => showError(input, errorFor(input)));
    });
})();
