// WeatherIcon.js is released as
// "Creative Commons - Attribution - ShareAlike 3.0".
//
// http://creativecommons.org/licenses/by-sa/3.0/
//
//
//
// You are free to:
//
// Share � copy and redistribute the material in any medium or format
// Adapt � remix, transform, and build upon the material for any purpose, even commercially.
//
// The licensor cannot revoke these freedoms as long as you follow the license terms.
//
//
//
// Under the following terms:
//
// Attribution � You must give appropriate credit, provide a link to the license, and indicate if changes were made. You may do so in any reasonable manner, but not in any way that suggests the licensor endorses you or your use.
// ShareAlike � If you remix, transform, or build upon the material, you must distribute your contributions under the same license as the original.
//
// No additional restrictions � You may not apply legal terms or technological measures that legally restrict others from doing anything the license permits.
//
//
//
// Notices:
//
// You do not have to comply with the license for elements of the material in the public domain or where your use is permitted by an applicable exception or limitation.
// No warranties are given. The license may not give you all of the permissions necessary for your intended use. For example, other rights such as publicity, privacy, or moral rights may limit how you use the material.

"use strict";
var WeatherIcon = (function () {
  function e(t, n, r) {
    this.isPlaying = false;
    this.canvas = new e.Canvas(t);
    this.canvas.setCanvasSize(128, 128);
    this.fps = 30;
    this.particlesBorder = 20;
    this.spf = 1e3 / this.fps;
    this.objects = [];
    this.particles = [];
    this.timer = false;
    this.canvas.ctx.fillStyle = "#fff";
    if (n) {
      this.stroke = true;
      this.canvas.ctx.lineWidth = 2;
      this.canvas.ctx.strokeStyle = "#000";
    } else {
      this.stroke = false;
      this.canvas.ctx.strokeStyle = "transparent";
    }
    if (r) {
      this.canvas.ctx.shadowOffsetX = 0;
      this.canvas.ctx.shadowOffsetY = 0;
      this.canvas.ctx.shadowBlur = 5;
      this.canvas.ctx.shadowColor = "black";
    }
  }
  e.Canvas = (function () {
    function e(t, n) {
      if (t) {
        if (t.nodeName == "CANVAS") {
          this.canvas = t;
        } else {
          this.canvas = document.createElement("canvas");
          if (n) this.canvas.id = n;
          t.appendChild(this.canvas);
          if (e.ieMode) G_vmlCanvasManager.initElement(this.canvas);
        }
      } else {
        this.canvas = document.createElement("canvas");
        if (e.ieMode) G_vmlCanvasManager.initElement(this.canvas);
      }
      this.ctx = this.canvas.getContext("2d");
    }
    e.prototype = {
      setSize: function (e, t) {
        this.setCanvasSize(e, t);
        this.setHtmlSize(e + "px", t + "px");
      },
      setCanvasSize: function (e, t) {
        this.canvas.width = e;
        this.canvas.height = t;
      },
      setHtmlSize: function (e, t) {
        this.canvas.style.width = e;
        this.canvas.style.height = t;
      },
      drawBox: function (e, t, n) {
        this.ctx.beginPath();
        this.ctx.moveTo(n, 0);
        this.ctx.lineTo(e - n, 0);
        this.ctx.bezierCurveTo(e, 0, e, 0, e, n);
        this.ctx.lineTo(e, t - n);
        this.ctx.bezierCurveTo(e, t, e, t, e - n, t);
        this.ctx.lineTo(n, t);
        this.ctx.bezierCurveTo(0, t, 0, t, 0, t - n);
        this.ctx.lineTo(0, n);
        this.ctx.bezierCurveTo(0, 0, 0, 0, n, 0);
        this.ctx.fill();
      },
      clear: function () {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
      },
    };
    e.supported = function () {
      var e = document.createElement("canvas");
      return e.getContext ? true : false;
    };
    var t = -1,
      n = navigator.userAgent,
      r = new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");
    if (r.exec(n) != null) t = parseFloat(RegExp.$1);
    e.ieMode = t > -1 && t < 9;
    return e;
  })();
  e.Point = (function () {
    function t(e, t) {
      this.x = e || 0;
      this.y = t || 0;
    }
    t.prototype.add = function (e) {
      this.x += e.x;
      this.y += e.y;
    };
    t.prototype.set = function (e, t) {
      this.x = e;
      this.y = t;
    };
    t.prototype.prod = function (e) {
      this.x *= e;
      this.y *= e;
    };
    t.prototype.clone = function () {
      return new e.Point(this.x, this.y);
    };
    t.prototype.rotate = function (e) {
      var t = this.x;
      var n = this.y;
      this.x = t * e.x - n * e.y;
      this.y = t * e.y + n * e.x;
    };
    return t;
  })();
  e.Circle = function (e, t) {
    this.center = e;
    this.r = t;
  };
  e.prototype = {
    draw: function () {
      var e;
      this.canvas.clear();
      e = this.particles.length;
      while (e--) {
        this.particles[e].update(10);
        this.particles[e].draw(this.canvas.ctx);
      }
      e = this.objects.length;
      while (e--) {
        this.objects[e].update(10);
        this.objects[e].draw(this.canvas.ctx);
      }
    },
    update: function () {
      this.isPlaying = true;
      this.draw();
      this.timer = setTimeout(this.update.bind(this), this.spf);
    },
    play: function () {
      this.stop();
      this.update();
    },
    stop: function () {
      this.isPlaying = false;
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = false;
      }
    },
    setBody: function (e) {
      this.body = e;
    },
    setIcon: function (e) {
      this.icon = e;
    },
    toggle: function () {
      this.isPlaying ? this.stop() : this.play();
    },
    change: function (t, n) {
      this.icon = t;
      this.setIcon(t);
      this.setBody(n === e.NIGHT ? e.NIGHT : e.DAY);
      this.build();
      this.draw();
    },
    addRain: function (t) {
      t = t == e.LIGHT ? e.LIGHT : e.HEAVY;
      var n = 0.2,
        r = 0.2,
        i = 60,
        s = e.particles[t].length;
      while (s--) this.particles.push(new e.Drop(e.particles[t][s], n, r, i));
    },
    addSnow: function (t) {
      t = t == e.LIGHT ? e.LIGHT : e.HEAVY;
      var n = 0.2,
        r = 0.2,
        i = 60,
        s = e.particles[t].length;
      while (s--) this.particles.push(new e.Snow(e.particles[t][s], n, r, i));
    },
    addSleet: function () {
      var t = e.LIGHT,
        n = 0.2,
        r = 0.2,
        i = 60,
        s = e.particles[t].length;
      while (s--) {
        var o =
          s % 2
            ? new e.Drop(e.particles[t][s], n, r, i)
            : new e.Snow(e.particles[t][s], n, r, i);
        this.particles.push(o);
      }
    },
    build: function () {
      this.objects = [];
      this.particles = [];
      switch (this.icon) {
        case e.SUN:
          this.objects.push(
            this.body == e.DAY ? new e.Sun(64, 64, 30) : new e.Moon(64, 64, 30),
          );
          break;
        case e.LIGHTCLOUD:
          this.objects.push(new e.Cloud(80, 100, 40));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(64, 64, 30) : new e.Moon(64, 64, 30),
          );
          break;
        case e.PARTLYCLOUD:
          this.objects.push(new e.Cloud(68, 90, 80));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(64, 54, 30) : new e.Moon(64, 54, 30),
          );
          break;
        case e.CLOUD:
          this.objects.push(new e.Cloud(90, 80, 40));
          this.objects.push(new e.Cloud(68, 60, 80));
          break;
        case e.LIGHTRAINSUN:
          this.objects.push(new e.Cloud(68, 60, 80));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(40, 30, 20) : new e.Moon(40, 30, 20),
          );
          this.addRain(e.LIGHT);
          break;
        case e.SLEETSUN:
          this.objects.push(new e.Cloud(68, 60, 80));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(40, 30, 20) : new e.Moon(40, 30, 20),
          );
          this.addSleet();
          break;
        case e.SNOWSUN:
          this.objects.push(new e.Cloud(68, 60, 80));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(40, 30, 20) : new e.Moon(40, 30, 20),
          );
          this.addSnow(e.LIGHT);
          break;
        case e.SNOW:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.addSnow();
          break;
        case e.SNOWTHUNDER:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.addSnow(e.LIGHT);
          this.objects.push(new e.Thunder(55, 82, 0.8));
          break;
        case e.THUNDER:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.objects.push(new e.Thunder(30, 75, 0.6));
          this.objects.push(new e.Thunder(60, 80, 0.7));
          this.objects.push(new e.Thunder(90, 75, 0.6));
          break;
        case e.SLEETSUNTHUNDER:
          this.objects.push(new e.Cloud(68, 60, 80));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(40, 30, 20) : new e.Moon(40, 30, 20),
          );
          this.addSleet();
          this.objects.push(new e.Thunder(95, 85, 0.7));
          this.objects.push(new e.Thunder(58, 88, 0.8));
          break;
        case e.LIGHTRAINTHUNDERSUN:
          this.objects.push(new e.Cloud(68, 60, 80));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(40, 30, 20) : new e.Moon(40, 30, 20),
          );
          this.addRain(e.LIGHT);
          this.objects.push(new e.Thunder(30, 75, 0.6));
          this.objects.push(new e.Thunder(58, 90, 0.7));
          break;
        case e.SNOWSUNTHUNDER:
          this.objects.push(new e.Cloud(68, 60, 80));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(40, 30, 20) : new e.Moon(40, 30, 20),
          );
          this.addSnow(e.LIGHT);
          this.objects.push(new e.Thunder(30, 75, 0.6));
          this.objects.push(new e.Thunder(58, 90, 0.7));
          break;
        case e.LIGHTRAIN:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.addRain(e.LIGHT);
          break;
        case e.RAIN:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.addRain();
          break;
        case e.FOG:
          this.objects.push(new e.Fog(68, 90, 80));
          this.objects.push(
            this.body == e.DAY ? new e.Sun(64, 54, 30) : new e.Moon(64, 54, 30),
          );
          break;
        case e.LIGHTRAINTHUNDER:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.addRain(e.LIGHT);
          this.objects.push(new e.Thunder(30, 72, 0.7));
          this.objects.push(new e.Thunder(58, 88, 0.8));
          break;
        case e.RAINTHUNDER:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.addRain();
          this.objects.push(new e.Thunder(30, 72, 0.7));
          this.objects.push(new e.Thunder(58, 88, 0.8));
          break;
        case e.SLEETTHUNDER:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.addSleet();
          this.objects.push(new e.Thunder(95, 85, 0.7));
          this.objects.push(new e.Thunder(58, 88, 0.8));
          break;
        case e.EXTREME:
        case e.SLEET:
          this.objects.push(new e.Cloud(68, 50, 80));
          this.addSleet();
          break;
      }
    },
  };
  e.Cloud = (function () {
    var t = function (t, n, r) {
      t = t ? t : 68;
      n = n ? n : 50;
      r = r ? r : 80;
      var i = r * 0.5;
      var s = new e.Point(t, n);
      var o = new e.Point(r, i);
      var u = new e.Point(r >> 1, i >> 1);
      this.size = o;
      this.po = new e.Point(s.x - u.x, s.y);
      this.p1 = this.po.clone();
      this.p1.x += o.x;
      this.cl = new e.Circle(new e.Point(s.x - u.x, s.y), r * 0.14);
      this.cr = new e.Circle(new e.Point(s.x + u.x, s.y + r * 0.03), r * 0.1);
      this.ca = new e.Circle(new e.Point(s.x - u.x * 0.42, s.y), r * 0.35);
      this.cb = new e.Circle(new e.Point(s.x + u.x * 0.45, s.y), r * 0.25);
      this.cc = new e.Circle(new e.Point(s.x - u.x * 0.2, s.y), r * 0.28);
      this.pi = Math.PI;
      this.pi2 = this.pi / 2;
      this.p2 = new e.Point(+this.w, this.h);
    };
    t.prototype = {
      update: function (e) {},
      draw: function (e) {
        e.beginPath();
        e.arc(this.cl.center.x, this.cl.center.y, this.cl.r, 0, 2 * this.pi);
        e.arc(
          this.cl.center.x + this.cl.r,
          this.cl.center.y,
          this.cl.r,
          0,
          2 * this.pi,
        );
        e.arc(this.cc.center.x, this.cc.center.y, this.cc.r, 0, 2 * this.pi);
        e.arc(this.ca.center.x, this.ca.center.y, this.ca.r, this.pi, 0);
        e.arc(this.cb.center.x, this.cb.center.y, this.cb.r, 0, 2 * this.pi);
        e.arc(
          this.cr.center.x,
          this.cr.center.y,
          1.3 * this.cr.r,
          0,
          2 * this.pi,
        );
        e.closePath();
        e.stroke();
        e.fill();
      },
    };
    return t;
  })();
  e.Snow = (function () {
    var t = function (t, n, r, i) {
      this.angle = r;
      this.speed = n;
      this.posIni = t;
      this.w = 3;
      this.dy = this.w * 4;
      this.pos = this.posIni.clone();
      this.rot = new e.Point(Math.cos(this.angle), Math.sin(this.angle));
      this.v = new e.Point(0, this.speed);
      this.v.rotate(this.rot);
      this.po = new e.Point();
      this.po.add(this.pos);
      var s = this.po.y - i;
      var o = this.rot.y / this.rot.x;
      this.pr = new e.Point(this.po.x + s * o, i);
      this.angle = Math.PI / 3.5;
      this.angle2 = 2 * this.angle;
      this.r = this.w >> 1;
    };
    t.prototype = {
      reset: function () {
        this.po.set(0, 0);
        this.po.add(this.pr);
      },
      update: function (t) {
        var n = new e.Point(this.v.x * t, this.v.y * t);
        this.po.add(n);
        if (this.po.y > 128) {
          this.reset();
        }
      },
      draw: function (e) {
        e.beginPath();
        e.arc(this.po.x, this.po.y + this.dy, this.w, 0, 6.28);
        e.closePath();
        e.stroke();
        e.fill();
      },
    };
    return t;
  })();
  e.Drop = (function () {
    var t = function (t, n, r, i) {
      this.angle = r;
      this.speed = n;
      this.posIni = t;
      this.isFreeze = false;
      this.elongation = 2;
      this.w = 10;
      this.h = this.w * this.elongation;
      this.pos = this.posIni.clone();
      this.rot = new e.Point(Math.cos(this.angle), Math.sin(this.angle));
      this.v = new e.Point(0, this.speed);
      this.v.rotate(this.rot);
      this.po = new e.Point();
      this.p1 = new e.Point(-this.w, this.h);
      this.p2 = new e.Point(+this.w, this.h);
      this.p1.rotate(this.rot);
      this.p2.rotate(this.rot);
      this.po.add(this.pos);
      this.p1.add(this.pos);
      this.p2.add(this.pos);
      var s = this.po.y - i;
      var o = this.rot.y / this.rot.x;
      var u = this.po.x + s * o;
      this.pr = new e.Point(u, i);
    };
    t.prototype = {
      freeze: function () {
        this.isFreeze = true;
        this.angle = Math.PI / 3.5;
        this.r = this.w >> 1;
      },
      reset: function () {
        this.po.set(0, 0);
        this.p1.set(-this.w, this.h);
        this.p2.set(+this.w, this.h);
        this.p1.rotate(this.rot);
        this.p2.rotate(this.rot);
        this.po.add(this.pr);
        this.p1.add(this.pr);
        this.p2.add(this.pr);
      },
      update: function (t) {
        var n = new e.Point(this.v.x * t, this.v.y * t);
        this.po.add(n);
        this.p1.add(n);
        this.p2.add(n);
        if (this.po.y > 128) {
          this.reset();
        }
      },
      draw: function (e) {
        e.beginPath();
        if (this.isFreeze) {
          e.save();
          e.translate(this.po.x, this.po.y);
          e.rect(-this.r, 0, this.w, 1);
          e.restore();
          e.save();
          e.translate(this.po.x, this.po.y);
          e.rotate(this.angle);
          e.rect(-this.r, 0, this.w, 1);
          e.restore();
          e.save();
          e.translate(this.po.x, this.po.y);
          e.rotate(-this.angle);
          e.rect(-this.r, 0, this.w, 1);
          e.restore();
        } else {
          e.moveTo(this.po.x, this.po.y);
          e.bezierCurveTo(
            this.p1.x,
            this.p1.y,
            this.p2.x,
            this.p2.y,
            this.po.x,
            this.po.y + 1e-5,
          );
        }
        e.closePath();
        e.stroke();
        e.fill();
      },
    };
    return t;
  })();
  e.Thunder = (function () {
    function e(t, n, r) {
      this.so = r || 1;
      this.s = this.so;
      this.x = t;
      this.y = n;
      this.ti = 500 * Math.random();
      this.p = [];
      this.n = e.points.length;
    }
    e.prototype.update = function () {
      if (!this.t) {
        this.t = new Date().getTime() + this.ti;
        this.s = this.so;
        return;
      }
      var e = new Date().getTime();
      var t = e - this.t - this.ti;
      this.s = 0;
      if (t > 2e3) {
        this.s = 0;
        this.t = e;
      } else if (t > 1e3) this.s = this.so;
      else if (t > 700) this.s = Math.random() < 0.5 ? this.so : 0;
    };
    e.prototype.draw = function (t) {
      t.beginPath();
      t.save();
      t.translate(this.x, this.y);
      t.scale(this.s, this.s);
      t.moveTo(e.points[0].x, e.points[0].y);
      var n = this.n;
      while (n--) t.lineTo(e.points[n].x, e.points[n].y);
      t.stroke();
      t.fill();
      t.restore();
    };
    e.size = { w: 30, h: 45 };
    e.points = [
      { x: 0, y: 0 },
      { x: 0, y: 22 },
      { x: 13, y: 20 },
      { x: 3, y: 43 },
      { x: 28, y: 15 },
      { x: 12, y: 13 },
      { x: 21, y: 0 },
    ];
    return e;
  })();
  e.Sun = (function () {
    var t = function (t, n, r, i) {
      t = t ? t : 64;
      n = n ? n : 64;
      r = r ? r : 20;
      i = i ? i : r * 1.25;
      var s = new e.Point(t, n);
      this.rotation = { val: 0, inc: 0.001 };
      this.center = s;
      this.points = [];
      this.pointsExt = [];
      var o = 20;
      var u = 0;
      var a = Math.PI / o;
      while (o--) {
        var f = r * Math.cos(u);
        var l = r * Math.sin(u);
        this.points.push(new e.Point(f, l));
        u += a;
        var f = i * Math.cos(u);
        var l = i * Math.sin(u);
        this.pointsExt.push(new e.Point(f, l));
        u += a;
      }
    };
    t.prototype = {
      update: function (e) {},
      draw: function (e) {
        var t = this.points.length;
        var n = 0;
        e.save();
        e.translate(this.center.x, this.center.y);
        e.rotate((this.rotation.val += this.rotation.inc));
        e.beginPath();
        e.moveTo(this.pointsExt[t - 1].x, this.pointsExt[t - 1].y);
        for (n = 0; n < t; n++)
          e.quadraticCurveTo(
            this.points[n].x,
            this.points[n].y,
            this.pointsExt[n].x,
            this.pointsExt[n].y,
          );
        e.stroke();
        e.fill();
        e.restore();
      },
    };
    return t;
  })();
  e.Fog = (function () {
    var e = function () {
      this.angle = 0;
    };
    e.PI2 = Math.PI * 2;
    e.prototype = {
      update: function (e) {
        this.angle += 0.01;
      },
      draw: function (t) {
        var n;
        n = 0.2 * Math.cos(this.angle);
        t.beginPath();
        t.save();
        t.translate(85, 62);
        t.scale(13, 1);
        t.arc(n, 0, 2, 0, e.PI2);
        t.closePath();
        t.restore();
        t.stroke();
        t.fill();
        n = 0.2 * Math.cos(this.angle + 0.5);
        t.beginPath();
        t.save();
        t.translate(40, 70);
        t.scale(6, 0.5);
        t.arc(n, 0, 5, 0, e.PI2);
        t.closePath();
        t.restore();
        t.stroke();
        t.fill();
        n = 0.3 * Math.cos(this.angle);
        t.beginPath();
        t.save();
        t.translate(80, 80);
        t.scale(6, 0.5);
        t.arc(n, 0, 7, 0, e.PI2);
        t.closePath();
        t.restore();
        t.stroke();
        t.fill();
        n = 0.4 * Math.cos(this.angle + 0.9);
        t.beginPath();
        t.save();
        t.translate(56, 92);
        t.scale(10, 1);
        t.arc(n, 0, 5, 0, e.PI2);
        t.closePath();
        t.restore();
        t.stroke();
        t.fill();
        n = 0.2 * Math.cos(this.angle);
        t.beginPath();
        t.save();
        t.translate(100, 104);
        t.scale(7, 1);
        t.arc(n, 0, 3, 0, e.PI2);
        t.closePath();
        t.restore();
        t.stroke();
        t.fill();
      },
    };
    return e;
  })();
  e.Moon = (function () {
    function e(e, t, n) {
      this.x = e || 0;
      this.y = t || 0;
      this.r = n || 20;
      this.rotDirection = 1;
      this.rotAngle = 0;
      this.angleMax = (10 * Math.PI) / 180;
    }
    e.prototype = {
      update: function () {
        if (this.rotAngle > this.angleMax) this.rotDirection = -1;
        else if (this.rotAngle < -this.angleMax) this.rotDirection = 1;
        this.rotAngle += 0.002 * this.rotDirection;
      },
      draw: function (e) {
        e.save();
        e.translate(this.x, this.y);
        e.rotate(-0.6 + this.rotAngle);
        var t = 0.31 * Math.PI;
        e.beginPath();
        e.arc(0, 0, this.r, t, -t);
        e.arc(this.r, 0, this.r, Math.PI + t, Math.PI - t, true);
        e.stroke();
        e.fill();
        e.restore();
      },
    };
    return e;
  })();
  e.particles = {
    heavy: [
      new e.Point(22, 96),
      new e.Point(22, 116),
      new e.Point(36, 71),
      new e.Point(47, 95),
      new e.Point(47, 115),
      new e.Point(57, 64),
      new e.Point(66, 88),
      new e.Point(66, 108),
      new e.Point(78, 61),
      new e.Point(83, 94),
      new e.Point(83, 114),
      new e.Point(95, 72),
      new e.Point(104, 88),
      new e.Point(104, 108),
    ],
    light: [
      new e.Point(22, 96),
      new e.Point(36, 71),
      new e.Point(47, 110),
      new e.Point(66, 88),
      new e.Point(78, 61),
      new e.Point(83, 110),
      new e.Point(104, 88),
    ],
  };
  e.DAY = "Sun";
  e.NIGHT = "Moon";
  e.LIGHT = "light";
  e.HEAVY = "heavy";
  e.SUN = 1;
  e.LIGHTCLOUD = 2;
  e.PARTLYCLOUD = 3;
  e.CLOUD = 4;
  e.LIGHTRAINSUN = 5;
  e.LIGHTRAINTHUNDERSUN = 6;
  e.SLEETSUN = 7;
  e.SNOWSUN = 8;
  e.LIGHTRAIN = 9;
  e.RAIN = 10;
  e.RAINTHUNDER = 11;
  e.SLEET = 12;
  e.SNOW = 13;
  e.SNOWTHUNDER = 14;
  e.FOG = 15;
  e.SLEETSUNTHUNDER = 20;
  e.SNOWSUNTHUNDER = 21;
  e.LIGHTRAINTHUNDER = 22;
  e.SLEETTHUNDER = 23;
  e.DARKDAY_SUN = 16;
  e.DARKDAY_LIGHTCLOUD = 17;
  e.DARKDAY_LIGHTRAINSUN = 18;
  e.DARKDAY_SNOWSUN = 19;
  e.THUNDER = 50;
  e.EXTREME = 99;
  e.add = function (t, n, r) {
    if (typeof t == "string") t = document.getElementById(t);
    if (r == undefined) r = {};
    var i = new e(
      t,
      r.stroke === false ? false : true,
      r.shadow === true ? true : false,
    );
    i.setIcon(n);
    i.setBody(r.mode === e.NIGHT ? e.NIGHT : e.DAY);
    i.build();
    i.draw();
    if (r.animated === true) i.update();
    return i;
  };
  return e;
})();
