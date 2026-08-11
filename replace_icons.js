const fs = require('fs');
const path = require('path');

const directories = [
    'resources/views/layouts',
    'resources/views/public',
    'resources/views/components/public'
];

const iconMap = {
    'bi bi-arrow-up': 'fa-solid fa-arrow-up',
    'bi bi-shield-check': 'fa-solid fa-shield-halved',
    'bi bi-grid': 'fa-solid fa-table-cells',
    'bi bi-clock-history': 'fa-solid fa-clock-rotate-left',
    'bi bi-geo-alt-fill': 'fa-solid fa-location-dot',
    'bi bi-whatsapp': 'fa-brands fa-whatsapp',
    'bi bi-people-fill': 'fa-solid fa-users',
    'bi bi-house-door-fill': 'fa-solid fa-house',
    'bi bi-file-earmark-text-fill': 'fa-solid fa-file-lines',
    'bi bi-person-badge-fill': 'fa-solid fa-id-card',
    'bi bi-box-arrow-in-right': 'fa-solid fa-right-to-bracket',
    'bi bi-list': 'fa-solid fa-bars',
    'bi bi-x-lg': 'fa-solid fa-xmark',
    'bi bi-search': 'fa-solid fa-magnifying-glass',
    'bi bi-info-circle-fill': 'fa-solid fa-circle-info',
    'bi bi-newspaper': 'fa-solid fa-newspaper',
    'bi bi-arrow-right': 'fa-solid fa-arrow-right',
    'bi bi-megaphone': 'fa-solid fa-bullhorn',
    'bi bi-calendar3': 'fa-solid fa-calendar-days',
    'bi bi-calendar-x': 'fa-solid fa-calendar-xmark',
    'bi bi-geo-alt': 'fa-solid fa-location-dot',
    'bi bi-clock': 'fa-solid fa-clock',
    'bi bi-images': 'fa-solid fa-images',
    'bi bi-telephone-fill': 'fa-solid fa-phone',
    'bi bi-envelope-fill': 'fa-solid fa-envelope',
    'bi bi-map-fill': 'fa-solid fa-map',
    'bi bi-chevron-down': 'fa-solid fa-chevron-down',
    'bi bi-building-fill': 'fa-solid fa-building',
    'bi bi-diagram-3-fill': 'fa-solid fa-sitemap',
    'bi bi-shield-fill': 'fa-solid fa-shield',
    'bi bi-check-circle-fill': 'fa-solid fa-circle-check',
    'bi bi-bullseye': 'fa-solid fa-bullseye',
    'bi bi-bar-chart-line': 'fa-solid fa-chart-bar',
    'bi bi-arrow-up-circle-fill': 'fa-solid fa-circle-up',
    'bi bi-arrow-down-circle-fill': 'fa-solid fa-circle-down',
    'bi bi-arrow-right-circle-fill': 'fa-solid fa-circle-right',
    'bi bi-arrow-left-circle-fill': 'fa-solid fa-circle-left',
    'bi bi-person-lines-fill': 'fa-solid fa-address-book',
    'bi bi-send-check': 'fa-solid fa-paper-plane'
};

function processDirectory(dir) {
    if (!fs.existsSync(dir)) return;
    const files = fs.readdirSync(dir);
    
    for (const file of files) {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        
        if (stat.isDirectory()) {
            processDirectory(fullPath);
        } else if (fullPath.endsWith('.blade.php') && (fullPath.includes('public') || fullPath.includes('layouts/public'))) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let modified = false;
            
            for (const [bi, fa] of Object.entries(iconMap)) {
                const regex = new RegExp(bi, 'g');
                if (regex.test(content)) {
                    content = content.replace(regex, fa);
                    modified = true;
                }
            }

            // Fallback for dynamic icons or missed ones like `bi {{ $icon }}`
            if (content.includes('bi {{ $')) {
                content = content.replace(/bi \{\{ \$(.*?)\}\} text/g, 'fa-solid {{ $$1 }} text');
                content = content.replace(/bi \{\{ \$/g, 'fa-solid {{ $');
                modified = true;
            }

            // General replacement for remaining `bi bi-*` that were not in iconMap
            const remainingRegex = /bi bi-([a-z0-9\-]+)/g;
            if (remainingRegex.test(content)) {
                content = content.replace(remainingRegex, (match, p1) => {
                    return `fa-solid fa-${p1}`;
                });
                modified = true;
            }
            
            if (modified) {
                fs.writeFileSync(fullPath, content, 'utf8');
                console.log(`Updated: ${fullPath}`);
            }
        }
    }
}

directories.forEach(processDirectory);
console.log("Done replacing icons!");
