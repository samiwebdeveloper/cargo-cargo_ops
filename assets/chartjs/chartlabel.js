!(function(t) {
    "function" == typeof define && define.amd ? define(t) : t();
})(function() {
    "use strict";
    /**
     * [chartjs-plugin-labels]{@link https://github.com/DavideViolante/chartjs-plugin-labels}
     *
     * @version 3.0.0
     * @author Chen, Yi-Cyuan [emn178@gmail.com], Davide Violante
     * @copyright Chen, Yi-Cyuan 2017-2018
     * @license MIT
     */
    !(function() {
        if ("undefined" == typeof Chart)
            return void console.error("Cannot find Chart object.");
        const t = Chart.helpers;
        "function" != typeof Object.assign &&
            (Object.assign = function(t) {
                if (!t)
                    throw new TypeError("Cannot convert undefined or null to object");
                const e = Object(t);
                for (let t = 1; t < arguments.length; t++) {
                    const o = arguments[t];
                    if (o)
                        for (const t in o)
                            Object.prototype.hasOwnProperty.call(o, t) && (e[t] = o[t]);
                }
                return e;
            });
        const e = {};

        function o() {
            this.renderToDataset = this.renderToDataset.bind(this);
        }
        ["pie", "doughnut", "polarArea", "bar"].forEach(function(t) {
                e[t] = !0;
            }),
            (o.prototype.setup = function(t, e) {
                (this.chart = t),
                (this.ctx = t.ctx),
                (this.args = {}),
                (this.barTotal = {});
                const o = t.config.options;
                (this.options = Object.assign({
                        position: "default",
                        precision: 0,
                        fontSize: o.font ? o.font.size : 12,
                        fontColor: o.color || "#333333",
                        fontStyle: o.font ? o.font.style : "normal",
                        fontFamily: o.font ?
                            o.font.family :
                            "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                        shadowOffsetX: 3,
                        shadowOffsetY: 3,
                        shadowColor: "rgba(0,0,0,0.3)",
                        shadowBlur: 6,
                        images: [],
                        outsidePadding: 2,
                        textMargin: 2,
                        overlap: !0,
                    },
                    e
                )),
                "bar" === t.config.type &&
                    ((this.options.position = "default"),
                        (this.options.arc = !1),
                        (this.options.overlap = !0));
            }),
            (o.prototype.render = function() {
                (this.labelBounds = []),
                this.chart.data.datasets.forEach(this.renderToDataset);
            }),
            (o.prototype.renderToDataset = function(t, e) {
                (this.totalPercentage = 0), (this.total = null);
                const o = this.args[e];
                o.meta.data.forEach(
                    function(e, n) {
                        this.renderToElement(t, o, e, n);
                    }.bind(this)
                );
            }),
            (o.prototype.renderToElement = function(e, o, n, i) {
                if (!this.shouldRenderToElement(o.meta, n)) return;
                this.percentage = null;
                const s = this.getLabel(e, n, i);
                if (!s) return;
                const r = this.ctx;
                r.save(),
                    (r.font = t.fontString(
                        this.options.fontSize,
                        this.options.fontStyle,
                        this.options.fontFamily
                    ));
                const a = this.getRenderInfo(n, s);
                this.drawable(n, s, a) ?
                    (r.beginPath(),
                        (r.fillStyle = this.getFontColor(e, n, i)),
                        this.renderLabel(s, a),
                        r.restore()) :
                    r.restore();
            }),
            (o.prototype.renderLabel = function(t, e) {
                return this.options.arc ?
                    this.renderArcLabel(t, e) :
                    this.renderBaseLabel(t, e);
            }),
            (o.prototype.renderBaseLabel = function(t, e) {
                const o = this.ctx;
                if ("object" == typeof t)
                    o.drawImage(
                        t,
                        e.x - t.width / 2,
                        e.y - t.height / 2,
                        t.width,
                        t.height
                    );
                else {
                    o.save(),
                        (o.textBaseline = "top"),
                        (o.textAlign = "center"),
                        this.options.textShadow &&
                        ((o.shadowOffsetX = this.options.shadowOffsetX),
                            (o.shadowOffsetY = this.options.shadowOffsetY),
                            (o.shadowColor = this.options.shadowColor),
                            (o.shadowBlur = this.options.shadowBlur));
                    const n = t.split("\n");
                    for (let t = 0; t < n.length; t++) {
                        const i =
                            e.y -
                            (this.options.fontSize / 2) * n.length +
                            this.options.fontSize * t;
                        o.fillText(n[t], e.x, i);
                    }
                    o.restore();
                }
            }),
            (o.prototype.renderArcLabel = function(t, e) {
                const o = this.ctx,
                    n = e.radius,
                    i = e.view;
                if ((o.save(), o.translate(i.x, i.y), "string" == typeof t)) {
                    o.rotate(e.startAngle),
                        (o.textBaseline = "middle"),
                        (o.textAlign = "left");
                    const i = t.split("\n");
                    let s = 0;
                    const r = [];
                    let a,
                        h = 0;
                    "border" === this.options.position &&
                        (h = ((i.length - 1) * this.options.fontSize) / 2);
                    for (let t = 0; t < i.length; ++t)
                        (a = o.measureText(i[t])),
                        a.width > s && (s = a.width),
                        r.push(a.width);
                    for (let t = 0; t < i.length; ++t) {
                        const e = i[t],
                            l = (i.length - 1 - t) * -this.options.fontSize + h;
                        o.save();
                        const c = (s - r[t]) / 2;
                        o.rotate(c / n);
                        for (let t = 0; t < e.length; t++) {
                            const i = e.charAt(t);
                            (a = o.measureText(i)),
                            o.save(),
                                o.translate(0, -1 * n),
                                o.fillText(i, 0, l),
                                o.restore(),
                                o.rotate(a.width / n);
                        }
                        o.restore();
                    }
                } else
                    o.rotate((i.startAngle + Math.PI / 2 + e.endAngle) / 2),
                    o.translate(0, -1 * n),
                    this.renderLabel(t, { x: 0, y: 0 });
                o.restore();
            }),
            (o.prototype.shouldRenderToElement = function(t, e) {
                return (!t.hidden &&
                    (this.options.showZero || "polarArea" === this.chart.config.type ?
                        0 !== e.outerRadius :
                        0 !== e.circumference)
                );
            }),
            (o.prototype.getLabel = function(t, e, o) {
                let n;
                if ("function" == typeof this.options.render)
                    n = this.options.render({
                        label: this.chart.config.data.labels[o],
                        value: t.data[o],
                        percentage: this.getPercentage(t, e, o),
                        dataset: t,
                        index: o,
                    });
                else
                    switch (this.options.render) {
                        case "value":
                            n = t.data[o];
                            break;
                        case "label":
                            n = this.chart.config.data.labels[o];
                            break;
                        case "image":
                            n = this.options.images[o] ?
                                this.loadImage(this.options.images[o]) :
                                "";
                            break;
                        case "percentage":
                        default:
                            n = this.getPercentage(t, e, o) + "%";
                    }
                return (
                    "object" == typeof n ?
                    (n = this.loadImage(n)) :
                    n && (n = n.toString()),
                    n
                );
            }),
            (o.prototype.getFontColor = function(t, e, o) {
                let n = this.options.fontColor;
                return (
                    "function" == typeof n ?
                    (n = n({
                        label: this.chart.config.data.labels[o],
                        value: t.data[o],
                        percentage: this.getPercentage(t, e, o),
                        backgroundColor: t.backgroundColor[o],
                        dataset: t,
                        index: o,
                    })) :
                    "string" != typeof n &&
                    (n = n[o] || this.chart.config.options.color),
                    n
                );
            }),
            (o.prototype.getPercentage = function(t, e, o) {
                if (this.percentage) return this.percentage;
                let n;
                if (
                    "polarArea" === this.chart.config.type ||
                    "doughnut" === this.chart.config.type ||
                    "pie" === this.chart.config.type
                ) {
                    if (!this.total) {
                        this.total = 0;
                        for (let e = 0; e < t.data.length; ++e) this.total += t.data[e];
                    }
                    n = (t.data[o] / this.total) * 100;
                } else if ("bar" === this.chart.config.type) {
                    if (!this.barTotal[o]) {
                        this.barTotal[o] = 0;
                        for (let t = 0; t < this.chart.data.datasets.length; ++t)
                            this.barTotal[o] += this.chart.data.datasets[t].data[o];
                    }
                    n = (t.data[o] / this.barTotal[o]) * 100;
                } else
                    n = (e.circumference / this.chart.config.options.circumference) * 100;
                return (
                    (n = parseFloat(n.toFixed(this.options.precision))),
                    this.options.showActualPercentages ||
                    ("bar" === this.chart.config.type &&
                        (this.totalPercentage = this.barTotalPercentage[o] || 0),
                        (this.totalPercentage += n),
                        this.totalPercentage > 100 &&
                        ((n -= this.totalPercentage - 100),
                            (n = parseFloat(n.toFixed(this.options.precision)))),
                        "bar" === this.chart.config.type &&
                        (this.barTotalPercentage[o] = this.totalPercentage)),
                    (this.percentage = n),
                    n
                );
            }),
            (o.prototype.getRenderInfo = function(t, e) {
                return "bar" === this.chart.config.type ?
                    this.getBarRenderInfo(t, e) :
                    this.options.arc ?
                    this.getArcRenderInfo(t, e) :
                    this.getBaseRenderInfo(t, e);
            }),
            (o.prototype.getBaseRenderInfo = function(t, e) {
                if (
                    "outside" === this.options.position ||
                    "border" === this.options.position
                ) {
                    let o,
                        n = {};
                    const i = t,
                        s = i.startAngle + (i.endAngle - i.startAngle) / 2,
                        r = i.outerRadius / 2;
                    if (
                        ("border" === this.options.position ?
                            (o = (i.outerRadius - r) / 2 + r) :
                            "outside" === this.options.position &&
                            (o = i.outerRadius - r + r + this.options.textMargin),
                            (n = { x: i.x + Math.cos(s) * o, y: i.y + Math.sin(s) * o }),
                            "outside" === this.options.position)
                    ) {
                        const t = this.options.textMargin + this.measureLabel(e).width / 2;
                        n.x += n.x < i.x ? -t : t;
                    }
                    return n;
                }
                return t.tooltipPosition();
            }),
            (o.prototype.getArcRenderInfo = function(t, e) {
                let o;
                const n = t;
                o =
                    "outside" === this.options.position ?
                    n.outerRadius + this.options.fontSize + this.options.textMargin :
                    "border" === this.options.position ?
                    (n.outerRadius / 2 + n.outerRadius) / 2 :
                    (n.innerRadius + n.outerRadius) / 2;
                let i = n.startAngle,
                    s = n.endAngle;
                const r = s - i;
                (i += Math.PI / 2), (s += Math.PI / 2);
                return (
                    (i += (s - (this.measureLabel(e).width / o + i)) / 2), { radius: o, startAngle: i, endAngle: s, totalAngle: r, view: n }
                );
            }),
            (o.prototype.getBarRenderInfo = function(t, e) {
                const o = t.tooltipPosition();
                return (
                    (o.y -= this.measureLabel(e).height / 2 + this.options.textMargin), o
                );
            }),
            (o.prototype.drawable = function(t, e, o) {
                if (this.options.overlap) return !0;
                if (this.options.arc) return o.endAngle - o.startAngle <= o.totalAngle; {
                    const n = this.measureLabel(e),
                        i = o.x - n.width / 2,
                        s = o.x + n.width / 2,
                        r = o.y - n.height / 2,
                        a = o.y + n.height / 2;
                    return "outside" === this.options.renderInfo ?
                        this.outsideInRange(i, s, r, a) :
                        t.inRange(i, r) &&
                        t.inRange(i, a) &&
                        t.inRange(s, r) &&
                        t.inRange(s, a);
                }
            }),
            (o.prototype.outsideInRange = function(t, e, o, n) {
                const i = this.labelBounds;
                for (let s = 0; s < i.length; ++s) {
                    const r = i[s];
                    let a = [
                        [t, o],
                        [t, n],
                        [e, o],
                        [e, n],
                    ];
                    for (let t = 0; t < a.length; ++t) {
                        const e = a[t][0],
                            o = a[t][1];
                        if (e >= r.left && e <= r.right && o >= r.top && o <= r.bottom)
                            return !1;
                    }
                    a = [
                        [r.left, r.top],
                        [r.left, r.bottom],
                        [r.right, r.top],
                        [r.right, r.bottom],
                    ];
                    for (let i = 0; i < a.length; ++i) {
                        const s = a[i][0],
                            r = a[i][1];
                        if (s >= t && s <= e && r >= o && r <= n) return !1;
                    }
                }
                return i.push({ left: t, right: e, top: o, bottom: n }), !0;
            }),
            (o.prototype.measureLabel = function(t) {
                if ("object" == typeof t) return { width: t.width, height: t.height }; {
                    let e = 0;
                    const o = t.split("\n");
                    for (let t = 0; t < o.length; ++t) {
                        const n = this.ctx.measureText(o[t]);
                        n.width > e && (e = n.width);
                    }
                    return { width: e, height: this.options.fontSize * o.length };
                }
            }),
            (o.prototype.loadImage = function(t) {
                const e = new Image();
                return (e.src = t.src), (e.width = t.width), (e.height = t.height), e;
            }),
            Chart.register({
                id: "labels",
                beforeDatasetsUpdate: function(t, n, i) {
                    if (!e[t.config.type]) return;
                    Array.isArray(i) || (i = [i]);
                    const s = i.length;
                    (t._labels && s === t._labels.length) ||
                    (t._labels = i.map(function() {
                        return new o();
                    }));
                    let r = !1,
                        a = 0;
                    for (let e = 0; e < s; ++e) {
                        const o = t._labels[e];
                        if ((o.setup(t, i[e]), "outside" === o.options.position)) {
                            r = !0;
                            const t = 1.5 * o.options.fontSize + o.options.outsidePadding;
                            t > a && (a = t);
                        }
                    }
                    r && ((t.chartArea.top += a), (t.chartArea.bottom -= a));
                },
                afterDatasetUpdate: function(t, o) {
                    e[t.config.type] &&
                        t._labels.forEach(function(t) {
                            t.args[o.index] = o;
                        });
                },
                beforeDraw: function(t) {
                    e[t.config.type] &&
                        t._labels.forEach(function(t) {
                            t.barTotalPercentage = {};
                        });
                },
                afterDatasetsDraw: function(t) {
                    e[t.config.type] &&
                        t._labels.forEach(function(t) {
                            t.render();
                        });
                },
            });
    })();
});