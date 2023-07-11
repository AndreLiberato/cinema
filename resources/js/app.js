import './bootstrap';
import Alpine from 'alpinejs';
import { Tooltip, Select, Datepicker, Input, initTE } from "tw-elements";

initTE({ Tooltip, Select, Datepicker, Input });

const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-te-toggle="tooltip"]'));
tooltipTriggerList.map((tooltipTriggerEl) => new Tooltip(tooltipTriggerEl));
window.Alpine = Alpine;

Alpine.start();
