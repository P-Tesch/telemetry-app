import { exec } from "child_process";
import path from "path";

export default function viewTsGenerator(options = {}) {
    const {
        root = "./../app/Views",
        command = "php artisan app:generate-views-ts && php artisan wayfinder:generate",
    } = options;

    let watching = false;
    let watcher;

    return {
        name: "view-ts-generator",

        configureServer(server) {
            if (watching) return;
            watching = true;

            const fullPath = path.resolve(process.cwd(), root);
            const { watcher: chokidarWatcher } = server;
            watcher = chokidarWatcher.add(fullPath);

            const runCommand = () => {
                console.log(`\n[view-ts-generator] Running: ${command}...`);
                const proc = exec(command, (error, stdout, stderr) => {
                    if (error) {
                        console.error(`[view-ts-generator] Error: ${error.message}`);
                        return;
                    }
                    if (stderr) console.error(`[view-ts-generator] ${stderr}`);
                    if (stdout) console.log(`[view-ts-generator] ${stdout}`);
                });

                proc.stdout?.pipe(process.stdout);
                proc.stderr?.pipe(process.stderr);
            };

            watcher.on("change", (file) => {
                if (file.endsWith("View.php")) {
                    console.log(`[view-ts-generator] Detected change in: ${file}`);
                    runCommand();
                }
            });

            watcher.on("add", (file) => {
                if (file.endsWith("View.php")) {
                    console.log(`[view-ts-generator] New view file detected: ${file}`);
                    runCommand();
                }
            });

            watcher.on("unlink", (file) => {
                if (file.endsWith("View.php")) {
                    console.log(`[view-ts-generator] View file removed: ${file}`);
                    runCommand();
                }
            });
        },
    };
}
