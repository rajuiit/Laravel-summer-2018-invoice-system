class CircleGraph extends HTMLElement {
    constructor() {
        super();

        this.canvas = document.createElement('canvas');
        this.ctx = this.canvas.getContext('2d');
        this.attachShadow({mode: 'open'});
        this.shadowRoot.appendChild(this.canvas);
        this.canvas.width=this.width;
        this.canvas.height=this.height;
        this.draw();
    }
    draw(item=null){
        if(this.kids && this.kids.find((it)=>it==item)){
            return;
        }
        const items = this.getItems();
        const sum = items.reduce((sum, value)=> sum+parseInt(value.value), 0);
        const ctx = this.ctx;
        let startAngle=0;
        const centerX = this.height/2, centerY = this.height/2, radius = Math.min(centerX, centerY);

        let drawText = [];

        Rx.Observable.interval(100)
            .take(items.length)
            .subscribe(i => {
                    const item = items[i];
                    ctx.beginPath();
                    let percent = (item.value/sum);
                    let endAngle = percent*360* Math.PI/180 + startAngle;
                    let hue = 360*i/items.length;
                    ctx.fillStyle=`hsl(${hue}, 50%, 50%)`;
                    ctx.moveTo(centerX, centerY);
                    ctx.arc(centerX, centerY, radius, startAngle, endAngle, false);
                    ctx.fillRect(radius*2+10, i*35+5, 20, 20);
                    ctx.fill();
                    let angle = startAngle+(endAngle-startAngle)/2;
                    drawText.push({
                        name: item.name,
                        func: ()=>{
                            ctx.fillText(item.name, radius*2+40, i*35+15)
                            const rMod = Math.max(0.5, 0.9-percent);
                            const textX = Math.cos(angle)*radius*rMod+centerX;
                            const textY = Math.sin(angle)*radius*rMod+centerY;
                            ctx.fillText((percent*100).toPrecision(2)+"%", textX, textY);
                        }});
                    startAngle=endAngle;
                    this.kids[i].setAttribute('displayed', '');
                },
                (err)=>console.log(err),
                () => {
                    ctx.textAlign='center';
                    ctx.textBaseline='middle';
                    ctx.font = '14px sans-serif';
                    ctx.fillStyle="black";
                    Rx.Observable.from(drawText)
                        .subscribe(
                            (t)=>t.func()
                        );
                }
            );

        /* items.forEach((item, i) => {
           ctx.beginPath();
           let percent = (item.value/sum);
           let endAngle = percent*360* Math.PI/180 + startAngle;
           console.log(`${startAngle} ${endAngle}`);
           let hue = 360*i/items.length;
           ctx.fillStyle=`hsl(${hue}, 50%, 50%)`;
           ctx.moveTo(centerX, centerY);
           ctx.arc(centerX, centerY, radius, startAngle, endAngle, false);
           ctx.fillRect(radius*2+10, i*35+5, 20, 20);
           ctx.fill();
           let angle = startAngle+(endAngle-startAngle)/2;
           drawText.push({
             name: item.name,
             func: ()=>{
               ctx.fillText(item.name, radius*2+40, i*35+15)
               const rMod = Math.max(0.5, 0.9-percent);
               const textX = Math.cos(angle)*radius*rMod+centerX;
               const textY = Math.sin(angle)*radius*rMod+centerY;
               ctx.fillText((percent*100).toPrecision(2)+"%", textX, textY);
             }});
           startAngle=endAngle;
           this.kids[i].setAttribute('displayed', '');
         });*/
    }
    getItems() {
        this.kids = [...this.getElementsByTagName('graph-item')];
        return this.kids.map(item=>{
            return { 'name': item.getAttribute('name'),
                'value': item.getAttribute('value')
            };
        });
    }
    get width() {
        return parseInt(this.getAttribute('width'));
    }
    set width(v) {
        this.setAttribute('width', v);
    }
    get height() {
        return parseInt(this.getAttribute('height'));
    }
    set height(v) {
        this.setAttribute('height', v);
    }
}

class GraphItem extends HTMLElement {
    constructor() { super(); }
    connectedCallback() {
        if(!this.getAttribute('displayed'))
        {
            this.parentElement.draw(this);
        }
    }
    get name() {
        return this.getAttribute('name');
    }
    set name(v) {
        return this.setAttribute('name', v);
    }
    get value() {
        return this.getAttribute('value');
    }
    set value(v) {
        return this.setAttribute('value', v);
    }
}

customElements.define('circle-graph', CircleGraph);
customElements.define('graph-item', GraphItem);
