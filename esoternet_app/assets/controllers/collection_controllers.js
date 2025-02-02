import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["container"];

    addItem(event) {
        event.preventDefault();
        const prototype = this.containerTarget.dataset.prototype;
        const index = this.containerTarget.children.length;
        const newForm = prototype.replace(/__name__/g, index);
        this.containerTarget.insertAdjacentHTML('beforeend', newForm);
    }
}
