import { Link } from "react-router";

interface Section {
  className: string;
  icon?: string;
  title: string;
  description: string;
  link: {
    href: string;
    text: string;
  };
}
const HomeSection = ({ section }: { section: Section }) => (
      <section className={section.className}>
        <div className={`${section.className}-content`}>
          {section.icon && <i className={`fa ${section.icon}`}></i>}
          <h2>{section.title}</h2>
          <p>{section.description}</p>
        </div>
        <Link to={section.link.href} className={`${section.className}-cta`}>
          <button>{section.link.text}</button>
        </Link>
      </section>
    );
export default HomeSection;