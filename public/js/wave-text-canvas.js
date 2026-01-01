// Wave Text Animation with Canvas - FINAL FIX
class WaveTextAnimation {
    constructor(canvasId, text) {
        this.canvas = document.getElementById(canvasId);
        if (!this.canvas) return;
        
        this.ctx = this.canvas.getContext('2d');
        this.text = text;
        this.scrollSpeed = 1;
        
        // Wave parameters
        this.amplitude = 65; // untuk atur tinggi gelombang
        this.frequency = 0.004; // untuk panjang gelombang/rapat tidaknya, besar = banyak
        this.letterSpacing = 40; // untuk atur jarak antar huruf
        
        // DPI untuk ketajaman
        this.dpr = window.devicePixelRatio || 1;
        
        this.setupCanvas();
        
        // Text mulai dari tengah layar, bukan dari luar
        this.scrollOffset = 0;
        
        this.animate();
        
        window.addEventListener('resize', () => {
            this.setupCanvas();
        });
    }
    
    setupCanvas() {
        const rect = this.canvas.getBoundingClientRect();
        
        this.dpr = Math.max(window.devicePixelRatio || 1, 2); // Minimal 2x untuk ketajaman
        
        this.canvas.width = rect.width * this.dpr;
        this.canvas.height = rect.height * this.dpr;
        this.canvas.style.width = rect.width + 'px';
        this.canvas.style.height = rect.height + 'px';
        
        this.ctx.scale(this.dpr, this.dpr);
        
        this.centerY = rect.height / 2;
        this.canvasWidth = rect.width;
        
        this.ctx.textRendering = 'optimizeLegibility';
    }
    
    drawLetter(letter, x, y, rotation) {
        this.ctx.save();
        this.ctx.translate(x, y);
        this.ctx.rotate(rotation);
        
        this.ctx.font = 'bold 64px "Playfair Display", serif';
        
        // COLOR
        this.ctx.fillStyle = '#681d1d';
        //this.ctx.fillStyle = '#6f7b91';
        //this.ctx.fillStyle = '#909873';
        //this.ctx.fillStyle = '#927458';

        this.ctx.textAlign = 'center';
        this.ctx.textBaseline = 'middle';
        
        // Anti-aliasing
        this.ctx.imageSmoothingEnabled = true;
        this.ctx.imageSmoothingQuality = 'high';
        
        this.ctx.fillText(letter, 0, 0);
        this.ctx.restore();
    }
    
    animate() {
        // Clear dengan display size (bukan canvas internal size)
        this.ctx.clearRect(0, 0, this.canvasWidth, this.centerY * 2);
        
        this.scrollOffset += this.scrollSpeed;
        
        const textWidth = this.text.length * this.letterSpacing;
        const totalTextNeeded = Math.ceil((this.canvasWidth + textWidth * 2) / textWidth) + 2;
        
        // Draw multiple copies of text untuk seamless loop
        for (let copy = 0; copy < totalTextNeeded; copy++) {
            const copyOffset = copy * textWidth;
            
            for (let i = 0; i < this.text.length; i++) {
                const letter = this.text[i];
                
                // Text dimulai dari posisi negatif agar sudah visible di awal
                let x = (i * this.letterSpacing) + copyOffset - (this.scrollOffset % textWidth);
                
                // Skip jika di luar viewport (dengan buffer)
                if (x < -100 || x > this.canvasWidth + 100) continue;
                
                // Calculate Y position (sine wave)
                const y = this.centerY + Math.sin(x * this.frequency) * this.amplitude;
                
                // Calculate rotation berdasarkan slope
                const slopeAngle = Math.cos(x * this.frequency) * this.frequency * this.amplitude;
                const rotation = Math.atan(slopeAngle);
                
                this.drawLetter(letter, x, y, rotation);
            }
        }
        
        requestAnimationFrame(() => this.animate());
    }
}

// Initialize
// document.addEventListener('DOMContentLoaded', () => {
//     new WaveTextAnimation('waveCanvas', "WE ARE HERE   ");
// });

// Expose constructor so views can instantiate with custom canvas id + text
window.WaveTextAnimation = WaveTextAnimation;