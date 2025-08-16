import fs from "fs";
import path from "path";

export async function getTranslations(locale: string) {
    const filePath = path.join(process.cwd(), "translations", locale, "main.json");

    try {
        const fileContents = await fs.promises.readFile(filePath, "utf-8");
        return JSON.parse(fileContents);
    } catch (err) {
        console.warn(`Translation file not found for locale "${locale}", fallback to "en"`);
        const fallbackPath = path.join(process.cwd(), "translations", "en", "main.json");
        const fileContents = await fs.promises.readFile(fallbackPath, "utf-8");
        return JSON.parse(fileContents);
    }
}