// Wave Text Animation with Canvas - FINAL FIX
class WaveTextAnimation {
    constructor(canvasId, text) {
        this.canvas = document.getElementById(canvasId);
        if (!this.canvas) return;
        
        this.ctx = this.canvas.getContext('2d');
        this.text = text;
        this.scrollSpeed = 1;
        
        // Wave parameters
        this.amplitude = 70;
        this.frequency = 0.003;
        this.letterSpacing = 40;
        
        // DPI untuk ketajaman
        this.dpr = window.devicePixelRatio || 1;
        
        this.setupCanvas();
        
        // 🔥 FIX #1: Hitung initial offset agar text sudah ada di layar dari awal
        // Text mulai dari tengah layar, bukan dari luar
        this.scrollOffset = 0;
        
        this.animate();
        
        window.addEventListener('resize', () => {
            this.setupCanvas();
        });
    }
    
    setupCanvas() {
        const rect = this.canvas.getBoundingClientRect();
        
        // 🔥 FIX #3: Higher DPI untuk text lebih tajam
        this.dpr = Math.max(window.devicePixelRatio || 1, 2); // Minimal 2x untuk ketajaman
        
        this.canvas.width = rect.width * this.dpr;
        this.canvas.height = rect.height * this.dpr;
        this.canvas.style.width = rect.width + 'px';
        this.canvas.style.height = rect.height + 'px';
        
        this.ctx.scale(this.dpr, this.dpr);
        
        this.centerY = rect.height / 2;
        this.canvasWidth = rect.width;
        
        // 🔥 FIX #3: Enable font smoothing
        this.ctx.textRendering = 'optimizeLegibility';
    }
    
    drawLetter(letter, x, y, rotation) {
        this.ctx.save();
        this.ctx.translate(x, y);
        this.ctx.rotate(rotation);
        
        // 🔥 FIX #3: Font rendering optimization
        this.ctx.font = 'bold 64px "Playfair Display", serif';
        this.ctx.fillStyle = '#681d1d';
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
        
        // 🔥 FIX #2: Hitung berapa banyak text yang dibutuhkan untuk fill layar + buffer
        const textWidth = this.text.length * this.letterSpacing;
        const totalTextNeeded = Math.ceil((this.canvasWidth + textWidth * 2) / textWidth) + 2;
        
        // Draw multiple copies of text untuk seamless loop
        for (let copy = 0; copy < totalTextNeeded; copy++) {
            const copyOffset = copy * textWidth;
            
            for (let i = 0; i < this.text.length; i++) {
                const letter = this.text[i];
                
                // 🔥 FIX #1 & #2: Posisi X yang benar untuk seamless loop
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
document.addEventListener('DOMContentLoaded', () => {
    new WaveTextAnimation('waveCanvas', "WE ARE HERE   ");
});